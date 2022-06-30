<?php

namespace App\Models;

use Validator;
use session;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use \App\Utils\DateTimeInherit;
use DateTime;
use DateInterval;
use Exception;
use DB;

class Callcenter extends Model
{
    use \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;
    public $table = 'callcenters';
    protected $casts = [
        'time_start'  => 'datetime:Y-m-d H:i',
        'time_end' => 'datetime:Y-m-d H:i',
        'actual_time_start'  => 'datetime:Y-m-d H:i',
        'actual_time_end' => 'datetime:Y-m-d H:i',
        'actual_rest_time_start'  => 'datetime:Y-m-d H:i',
        'actual_rest_time_end' => 'datetime:Y-m-d H:i',
    ];
    
    protected $guarded = [];

    public function place()
    {
        return $this->belongsTo(\App\Models\Place::Class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::Class);
    }

    public function register($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'user_id' => [
                    'required',
                    Rule::exists('users', 'id')->where(function ($query) {
                        return $query->where('is_active', 1);
                    }),
                ],
                'place_id' => [
                    'required',
                    Rule::exists('places', 'id')->where(function ($query) {
                        return $query->where('is_active', 1);
                    }),
                ],
                'date_period' => 'required|date',
                'time_start' => 'required|date_format:Y-m-d H:i:s',
                'time_end' => 'required|date_format:Y-m-d H:i:s',
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails()){
                return $validator;
            }

            $this->fill($data);
            $this->setShift();
            $this->setWages();
            $this->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            return $validator->getMessageBag()->add('user_id', $e->getMessage());
        }
    }

    public function edit($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'place_id' => [
                    'required',
                    Rule::exists('places', 'id')->where(function ($query) {
                        return $query->where('is_active', 1);
                    }),
                ],
                'actual_time_start' => 'nullable|date_format:Y-m-d H:i:s',
                'actual_time_end' => 'nullable|date_format:Y-m-d H:i:s',
                'actual_time_rest_start' => 'nullable|date_format:Y-m-d H:i:s',
                'actual_time_rest_end' => 'nullable|date_format:Y-m-d H:i:s',
                'actual_time_rest_start2' => 'nullable|date_format:Y-m-d H:i:s',
                'actual_time_rest_end2' => 'nullable|date_format:Y-m-d H:i:s',
                'actual_working_hour_payment' => 'nullable|numeric',
                'actual_overtime_hour_payment' => 'nullable|numeric',
                'transport_fee' => 'nullable|numeric',
                'user_payment' => 'nullable|numeric',
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails()){
                return $validator;
            }

            $this->fill($data);
            $this->setShift();

            $params = $this->calculateSimulation();
            if($params['actualTimeStart']) {
                if(isset($params['workingShiftWithRestOvertimeCalculation']['day'])) {
                    $this->actual_working_hour_day_shift = $params['workingShiftWithRestOvertimeCalculation']['day']['normal'];
                    $this->actual_overtime_hour_day_shift = $params['workingShiftWithRestOvertimeCalculation']['day']['overtime'];
                }
                if(isset($params['workingShiftWithRestOvertimeCalculation']['evening'])) {
                    $this->actual_working_hour_evening_shift = $params['workingShiftWithRestOvertimeCalculation']['evening']['normal'];
                    $this->actual_overtime_hour_evening_shift = $params['workingShiftWithRestOvertimeCalculation']['evening']['overtime'];
                }
                if(isset($params['workingShiftWithRestOvertimeCalculation']['overnight'])) {
                    $this->actual_working_hour_overnight_shift = $params['workingShiftWithRestOvertimeCalculation']['overnight']['normal'];
                    $this->actual_overtime_hour_overnight_shift = $params['workingShiftWithRestOvertimeCalculation']['overnight']['overtime'];
                }
                if(isset($params['restShiftCalculation']['day'])) {
                    $this->actual_rest_hour_day_shift = $params['restShiftCalculation']['day'];
                }
                if(isset($params['restShiftCalculation']['evening'])) {
                    $this->actual_rest_hour_evening_shift = $params['restShiftCalculation']['evening'];
                }
                if(isset($params['restShiftCalculation']['overnight'])) {
                    $this->actual_rest_hour_overnight_shift = $params['restShiftCalculation']['overnight'];
                }
                if(isset($params['typeCalculation']['normal'])) {
                    $this->actual_normal_hour = $params['typeCalculation']['normal'];
                }
                if(isset($params['typeCalculation']['overtime'])) {
                    $this->actual_overtime_hour = $params['typeCalculation']['overtime'];
                }

                $totalNormal = 0;
                $totalOvertime = 0;
                foreach($params['wageCalculation'] as $shift => $calculation) {
                    $normalKey = "actual_payment_normal_$shift";
                    $overtimeKey = "actual_payment_overtime_$shift";

                    $this->$normalKey = $calculation['normal'];
                    $this->$overtimeKey = $calculation['overtime'];

                    $totalNormal += $calculation["normal"];
                    $totalOvertime += $calculation["overtime"];
                }

                $this->actual_working_hour_payment = $totalNormal;
                $this->actual_overtime_hour_payment = $totalOvertime;
                $this->user_payment = $totalNormal + $totalOvertime + $this->transport_fee;
                $this->actual_payment = $this->user_payment;
            }
            $this->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            return $validator->getMessageBag()->add('user_id', $e->getMessage());
        }
    }

    public function request()
    {
        $this->status = "request";
        $this->save();
        
        return true;
    }

    public function setShift()
    {
        $placeId = $this->place_id;
        $period = $this->date_period;
        $startTime = new DateTimeInherit($this->time_start);

        $shifts = PlaceShiftHour::where('place_id', $placeId)->get();
        if (!$shifts)
            throw new Exception("場所シフト時間設定されていません。");
        $this->shift = 'day';

        foreach($shifts as $shift) {
            $shiftDuration = new DateTimeInherit($period.' '.$shift['start_hour']);
            if ($startTime >= $shiftDuration)
                $this->shift = $shift['shift'];
        }
    }

    public function setWages()
    {
        $placeId = $this->place_id;
        $wages = PlaceHourlyWage::where('place_id', $placeId)->first();

        if (!$wages)
            throw new Exception("場所時給設定されていません。");

        $this->day_wage = $wages['day'];
        $this->evening_wage = $wages['evening'];
        $this->overnight_wage = $wages['overnight'];
        $this->overtime_overnight_wage = $wages['overtime_overnight'];
        $this->overtime_wage = $wages['overtime'];
    }

    public function calculateSimulation()
    {
        // reset calculation
        $this->actual_working_hour_day_shift = "00:00";
        $this->actual_working_hour_evening_shift = "00:00";
        $this->actual_working_hour_overnight_shift = "00:00";
        $this->actual_overtime_hour_day_shift = "00:00";
        $this->actual_overtime_hour_evening_shift = "00:00";
        $this->actual_overtime_hour_overnight_shift = "00:00";
        $this->actual_rest_hour_day_shift = "00:00";
        $this->actual_rest_hour_evening_shift = "00:00";
        $this->actual_rest_hour_overnight_shift = "00:00";
        $this->actual_payment_normal_day = 0;
        $this->actual_payment_normal_evening = 0;
        $this->actual_payment_normal_overnight = 0;
        $this->actual_payment_overtime_day = 0;
        $this->actual_payment_overtime_evening = 0;
        $this->actual_payment_overtime_overnight = 0;
        $this->actual_normal_hour = 0;
        $this->actual_overtime_hour = 0;
        $this->actual_working_hour_payment = 0;
        $this->actual_overtime_hour_payment = 0;
        $this->user_payment = 0;

        $params = [
            'id' => $this->id,
            'user' => $this->user->name,
            'period' => $this->date_period,
            'place' => $this->place->name,
            'shift' => $this->shift,
            'transportFee' => $this->transport_fee,
            'timeStart' => $this->time_start,
            'timeEnd' => $this->time_end,
            'actualTimeStart' => null,
            'actualTimeEnd' => null,
            'actualWorkingHour' => null,
            'actualRestTimes' => null,
            'actualRestHour' => null,
            'workingShiftCalculation' => [],
            'restShiftCalculation' => [],
            'actualTotalWorkingHourAfterRest' => null,
            'typeCalculation' => [],
            'workingShiftAfterRestCalculation' => [],
            'workingShiftWithRestOvertimeCalculation' => [],
        ];
        $period = new DateTimeInherit($this->date_period);

        $oriWorkingShifts = PlaceShiftHour::where('place_id', $this->place_id)->get();
        if (!$oriWorkingShifts)
            throw new Exception("場所シフト時間設定されていません。");
        $wages = PlaceHourlyWage::where('place_id', $this->place_id)->first();
        if (!$wages)
            throw new Exception("場所時給設定されていません。");

        if(!$this->actual_time_start){
            $params = array_replace($params,$this->convertReadableDatetime($params));
            return $params;
        }
        $actualTimeStart = new DateTimeInherit($this->actual_time_start);
        $params['actualTimeStart'] = $actualTimeStart;

        if(!$this->actual_time_end){
            $params = array_replace($params,$this->convertReadableDatetime($params));
            return $params;
        }
        $actualTimeEnd = new DateTimeInherit($this->actual_time_end);
        $params['actualTimeEnd'] = $actualTimeEnd;

        $actualWorkingHour = $actualTimeStart->diff($actualTimeEnd);
        $params['actualWorkingHour'] = $actualWorkingHour;

        $actualRestTimes = [];
        if($this->actual_time_rest_start && $this->actual_time_rest_end)
            $actualRestTimes[] = [
                'timeStart' => new DateTimeInherit($this->actual_time_rest_start),
                'timeEnd' => new DateTimeInherit($this->actual_time_rest_end),
            ];
        
        if($this->actual_time_rest_start2 && $this->actual_time_rest_end2)
            $actualRestTimes[] = [
                'timeStart' => new DateTimeInherit($this->actual_time_rest_start2),
                'timeEnd' => new DateTimeInherit($this->actual_time_rest_end2),
            ];
        $params['actualRestTimes'] = $actualRestTimes;

        $actualRestHour = $this->calculateTotalHour($actualRestTimes);
        $params['actualRestHour'] = $actualRestHour;

        $workingShifts = $this->getApplicableShifts($period, $actualTimeStart->format('H:i'), $oriWorkingShifts);
        $params['actualTotalWorkingHourAfterRest'] = $this->subtractDateIntervals($actualWorkingHour, $actualRestHour);
        $params['restShiftCalculation'] = $this->getRestShiftsCalculation($actualRestTimes, $params['actualRestHour'], $workingShifts);
        $startWorkingShift = $this->getStartShift($actualTimeStart, $workingShifts);
        $params['workingShiftCalculation'] = $this->getShiftCalculation($startWorkingShift, $actualTimeStart, $actualTimeEnd, $params['actualWorkingHour'], $workingShifts);
        $params['workingShiftAfterRestCalculation'] = $this->getWorkingShiftAfterRestCalculation($params['workingShiftCalculation'], $params['restShiftCalculation'], $workingShifts, $period, $actualTimeStart);
        $params['workingShiftWithRestOvertimeCalculation'] = $this->getWorkingShiftWithRestOvertimeCalculation($params['workingShiftAfterRestCalculation'], $params['restShiftCalculation'], $params['actualTotalWorkingHourAfterRest'], $workingShifts, $period);
        $params['typeCalculation'] = $this->getTypeCalculation($params['workingShiftWithRestOvertimeCalculation']);
        $params['wageCalculation'] = $this->getWageCalculation($params['workingShiftWithRestOvertimeCalculation'], $wages);
        $params = array_replace($params,$this->convertReadableDatetime($params));

        return $params;
    }

    public static function setPlaceHourlyWages($data)
    {
        PlaceHourlyWage::where(["place_id" => $data["place_id"]])->delete();
        
        for($i = 0; $i < count($data["jobtype"]); $i++) {
            $wageData = [
                "place_id" => $data["place_id"],
                "jobtype" => $data["jobtype"][$i],
                "day_wage" => $data["day_wage"][$i],
                "evening_wage" => $data["evening_wage"][$i],
                "overnight_wage" => $data["overnight_wage"][$i],
                "overtime_overnight_wage" => $data["overtime_overnight_wage"][$i],
                "overtime_wage" => $data["overtime_wage"][$i],
                "holiday_wage" => $data["holiday_wage"][$i],
            ];
            $placeHourlyWage = new PlaceHourlyWage();
            $placeHourlyWage->add($wageData);
        }

        return true;
    }

    public static function getWages($data)
    {
        $wage = null;
        $wage = PlaceHourlyWage::where([
            "place_id" => $data["place_id"],
            "jobtype" => $data["jobtype"]
        ])->first();

        return $wage;
    }

    public function getTypeCalculation($workingShiftWithRestOvertimeCalculation)
    {
        $return = [
            'normal' => new DateInterval('PT0H'),
            'overtime' => new DateInterval('PT0H'),
        ];
        $total = 0;
        foreach($workingShiftWithRestOvertimeCalculation as $shift => $calculation) {
            foreach($calculation as $eachDuration => $value) {
                $return[$eachDuration] = $this->addDateIntervals($return[$eachDuration], $value);
            }
        }

        return $return;
    }

    public function getWageCalculation($workingShiftWithRestOvertimeCalculation, $wages)
    {
        $return = [];
        foreach($workingShiftWithRestOvertimeCalculation as $shift => $calculation) {
            $temp = [];
            foreach($calculation as $eachDuration => $value) {
                if($eachDuration == 'normal') {
                    $wagePerHour = $wages[$shift];
                } else {
                    $wagePerHour = (in_array($shift, ['day', 'evening'])) ? $wages['overtime'] : $wages['overtime_overnight'];
                }
                $wagePerMinute = $wagePerHour / 60;
                $calculatedWage = ($value->h * $wagePerHour) + ($value->i * $wagePerMinute);
                $temp[$eachDuration] = $calculatedWage;
            }
            $return[$shift] = $temp;
        }

        return $return;
    }

    public function convertReadableDatetime($params)
    {
        $return = [];
        $return['timeStart'] = $params['timeStart']->format('Y-m-d H:i');
        $return['timeEnd'] = $params['timeEnd']->format('Y-m-d H:i');
        $return['actualTimeStart'] = ($params['actualTimeStart']) ? $params['actualTimeStart']->format('Y-m-d H:i') : '';
        $return['actualTimeEnd'] = ($params['actualTimeEnd']) ? $params['actualTimeEnd']->format('Y-m-d H:i') : '';
        $return['actualWorkingHour'] = ($params['actualWorkingHour']) ? $params['actualWorkingHour']->format('%H:%I') : '00:00';

        $actualRestTimes = [];
        if($params['actualRestTimes']) {
            foreach($params['actualRestTimes'] as $actualRestTime) {
                $temp = [
                    'timeStart' => $actualRestTime['timeStart']->format('Y-m-d H:i'),
                    'timeEnd' => $actualRestTime['timeEnd']->format('Y-m-d H:i')
                ];
                $actualRestTimes[] = $temp;
            }
        }
        $return['actualRestTimes'] = $actualRestTimes;
        $return['actualRestHour'] = ($params['actualRestHour']) ? $params['actualRestHour']->format('%H:%I') : '';

        $workingShiftCalculation = [];
        foreach($params['workingShiftCalculation'] as $shift => $calculation) {
            $workingShiftCalculation[$shift] = $calculation->format('%H:%I');
        }
        $return['workingShiftCalculation'] = $workingShiftCalculation;

        $restShiftCalculation = [];
        foreach($params['restShiftCalculation'] as $shift => $calculation) {
            $restShiftCalculation[$shift] = $calculation->format('%H:%I');
        }
        $return['restShiftCalculation'] = $restShiftCalculation;
        $return['actualTotalWorkingHourAfterRest'] = ($params['actualTotalWorkingHourAfterRest']) ?  $params['actualTotalWorkingHourAfterRest']->format('%H:%I') : '';

        $workingShiftAfterRestCalculation = [];
        foreach($params['workingShiftAfterRestCalculation'] as $shift => $calculation) {
            $workingShiftAfterRestCalculation[$shift] = $calculation->format('%H:%I');
        }
        $return['workingShiftAfterRestCalculation'] = $workingShiftAfterRestCalculation;

        $workingShiftWithRestOvertimeCalculation = [];
        foreach($params['workingShiftWithRestOvertimeCalculation'] as $shift => $calculation) {
            $temp = [];
            foreach($calculation as $eachDuration => $value)
                $temp[$eachDuration] = $value->format('%H:%I');

            $workingShiftWithRestOvertimeCalculation[$shift] = $temp;
        }
        $return['workingShiftWithRestOvertimeCalculation'] = $workingShiftWithRestOvertimeCalculation;

        $typeCalculation = [];
        foreach($params['typeCalculation'] as $type => $value) {
            $typeCalculation[$type] = $value->format('%H:%I');;
        }
        $return['typeCalculation'] = $typeCalculation;

        return $return;
    }

    public function getApplicableShifts($period, $startTime, $oriShifts)
    {
        $return = [];
        
        // get first shift
        $startShift = 'day';
        if (strtotime($startTime) < strtotime($oriShifts[0]["start_hour"])) {
            $startShift = $oriShifts[2];
            $startShift = $startShift['shift'];
        } else {
            foreach($oriShifts as $each) {
                if (strtotime($startTime) >= strtotime($each["start_hour"])) {
                    $startShift = $each;
                    $startShift = $startShift['shift'];
                }
            }
        }

        // convert original shift to key value
        $kvShifts = [];
        foreach($oriShifts as $oriShift) {
            $kvShifts[$oriShift['shift']] = [$oriShift['start_hour'], $oriShift['end_hour'], $oriShift['overlap_hour'] ];
        }

        // max 3 shifts
        $nextShift = $startShift;
        for($i = 0; $i < 3; $i++) {
            $return[$nextShift] = $kvShifts[$nextShift];
            $nextShift = $this->getNextShift($kvShifts, $nextShift);
        }

        // convert return shifts to datetime object
        $nextDay = false;
        foreach($return as $shift => $value) {
            $periodFormatted = ($nextDay === true) ? $period->returnAdd(new DateInterval('P1D')) : $period;
            $periodFormattedString = $periodFormatted->format('Y-m-d');

            $start = new DateTimeInherit($periodFormattedString.' '.$value[0]);

            if(!$nextDay) {
                $periodFormatted = $period;
                if(strtotime($value[1]) < strtotime($value[0])) {
                    $periodFormatted = $period->returnAdd(new DateInterval('P1D'));
                    $nextDay = true;
                }
            }

            $periodFormattedString = $periodFormatted->format('Y-m-d');
            $end = new DateTimeInherit($periodFormattedString.' '.$value[1]);
            $duration = $start->diff($end);
            $overlap = $this->durationToInterval($value[2]);

            $return[$shift] = [$start, $end, $duration, $overlap];
        }

        return $return;

    }

    public function getStartShift($startTime, $workingShifts)
    {
        $startShift = 'day';
        foreach($workingShifts as $shiftName => $shiftHour) {
            if ($startTime >= $shiftHour[0])
                $startShift = $shiftName;
        }

        return $startShift;
    }

    public function getShiftCalculation($startShift, $actualStartTime, $actualEndTime, $remainingHour, $workingShifts)
    {
        $shifts = [];
        $startShiftInterval = $workingShifts[$startShift][2];
        $endTime = $actualStartTime;
        $endTime = $actualStartTime->returnAdd($remainingHour);

        if($endTime <= $workingShifts[$startShift][1]) {
            $shifts[$startShift] = $remainingHour;
        } else {
            $inShiftHour = $actualStartTime->diff($workingShifts[$startShift][1]);
            $shifts[$startShift] = $inShiftHour;
            $remainingHourAfterInShift = $workingShifts[$startShift][1]->diff($actualEndTime);
            $nextShift = $this->getNextShift($workingShifts, $startShift);

            $nextShiftCalculation = $this->getShiftCalculation($nextShift, $workingShifts[$startShift][1], $endTime, $remainingHourAfterInShift, $workingShifts);
            $shifts = array_merge($shifts, $nextShiftCalculation);
        }
        
        return $shifts;
    }

    public function getRestShiftsCalculation($actualRestTimes, $actualRestHour, $workingShifts)
    {
        $restShiftCalculation = [];
        $actualRestHourRemaining = $actualRestHour;
        foreach($actualRestTimes as $actualRestTime) {
            $startRestShift = $this->getStartShift($actualRestTime['timeStart'], $workingShifts);
            $temp = $this->getShiftCalculation($startRestShift, $actualRestTime['timeStart'], $actualRestTime['timeEnd'], $actualRestHourRemaining, $workingShifts);
            $i = 1;
            foreach($temp as $shift => $duration) {
                if(isset($restShiftCalculation[$shift])) {
                    $restShiftCalculation[$shift] = $this->addDateIntervals($restShiftCalculation[$shift], $actualRestHourRemaining);
                } else {
                    $restShiftCalculation[$shift] = $duration;
                }
                $actualRestHourRemaining = $this->subtractDateIntervals($actualRestHourRemaining, $duration);
                $i++;
            }
        }

        return $restShiftCalculation;
    }
    
    public function getWorkingShiftAfterRestCalculation($workingShiftCalculation, $restShiftCalculation, $workingShifts, $period, $startHour)
    {
        $return = [];
        $i = 0;
        foreach($workingShiftCalculation as $shift => $val) {

            if(isset($workingShiftCalculation[$shift])) {
                if(isset($restShiftCalculation[$shift])) {
                    $return[$shift] = $this->subtractDateIntervals($workingShiftCalculation[$shift], $restShiftCalculation[$shift]);
                } else {
                    $return[$shift] = $workingShiftCalculation[$shift];
                }
            }

            $startShiftHour = ($i == 0) ? $startHour : $workingShifts[$shift][0];
            $endShiftHour = $workingShifts[$shift][1];
            $overlap = $workingShifts[$shift][3];

            $startShiftHourAfterWorkingHour = $startShiftHour->returnAdd($workingShiftCalculation[$shift]);

            if($startShiftHourAfterWorkingHour >= $endShiftHour)
                $return[$shift] = $this->addDateIntervals($return[$shift], $overlap);
            
            $i++;
        }

        return $return;
    }

    public function getWorkingShiftWithRestOvertimeCalculation($workingShiftAfterRestCalculation, $restShiftCalculation, $actualTotalWorkingHourAfterRest, $workingShifts, $period)
    {
        $maxWorkingHour = new DateInterval('PT8H');
        $periodMaxWorkingHour = $period->returnAdd($maxWorkingHour);
        $accumulation = new DateInterval('PT0H');
        $isOvertime = false;
        $return = null;

        foreach($workingShiftAfterRestCalculation as $shift => $duration) {
            if(!$duration)
                continue;

            $temp = ['normal' => new DateInterval('PT0H'), 'overtime' => new DateInterval('PT0H')];

            $accumulationShift = $accumulation;
            $accumulation = $this->addDateIntervals($accumulation, $duration);

            $periodAccumulation = $period->returnAdd($accumulation);
            $workingShiftDuration = $workingShifts[$shift][2];
            
            if($periodAccumulation > $periodMaxWorkingHour) {
                if($isOvertime) {
                    $temp['normal'] = new DateInterval('PT0H');
                    $temp['overtime'] = $this->addDateIntervals($temp['overtime'], $duration);
                } else {
                    $remainingNormal = $this->subtractDateIntervals($maxWorkingHour, $accumulationShift);
                    $temp['normal'] = $this->addDateIntervals($temp['normal'], $remainingNormal);

                    $overtime = $this->subtractDateIntervals($duration, $remainingNormal);
                    $temp['overtime'] = $this->addDateIntervals($temp['overtime'], $overtime);
                }

                $isOvertime = true;
            } else {
                $temp['normal'] = $duration;
            }
            $return[$shift] = $temp;
        }

        return $return;
    }

    public function calculateTotalHour($timeStartEnds)
    {
        $totalHour = new DateInterval('PT0H');

        foreach($timeStartEnds as $timeStartEnd) {
            $duration = $timeStartEnd['timeStart']->diff($timeStartEnd['timeEnd']);
            $totalHour = $this->addDateIntervals($totalHour, $duration);
        }

        return $totalHour;
    }

    public function durationToInterval($duration)
    {
        $duration = explode(":",$duration);
        $hour = intval($duration[0]);
        $minute = intval($duration[1]);

        return new DateInterval("PT".$hour."H".$minute."M");
    }
    
    public function getNextShift($workingShifts, $current)
    {
        $workingShiftKeys = array_keys($workingShifts);
        $workingShiftSize = count($workingShiftKeys);
        $currIndex = array_search($current, $workingShiftKeys);
        if($currIndex+1 == $workingShiftSize)
            return $workingShiftKeys[0];
        
        $next = $workingShiftKeys[array_search($current, $workingShiftKeys)+1];

        return $next;
    }

    public function subtractDateIntervals($intervalOne, $intervalTwo)
    {
        $keys = ["s", "i", "h", "d", "m", "y"];

        $intervalArrayOne = array_intersect_key((array)$intervalOne, array_flip($keys));
        $intervalArrayTwo = array_intersect_key((array)$intervalTwo, array_flip($keys));
        
        $deposit = 0;
        $result = [];
        foreach($keys as $key) {
            $res = abs($intervalArrayOne[$key]) - abs($intervalArrayTwo[$key]);
            if($deposit > 0) {
                $res -= $deposit;
                $deposit = 0;
            }
            if($res < 0) {
                $res = 60 - abs($res);
                $deposit = 1;
            }
            $result[$key] = $res;
        }

        $result = array_reverse($result);
        return new DateInterval(vsprintf("P%dY%dM%dDT%dH%dM%dS", $result));
    }

    public function addDateIntervals($intervalOne, $intervalTwo)
    {
        $keys = ["y", "m", "d", "h", "i", "s"];

        $intervalArrayOne = array_intersect_key((array)$intervalOne, array_flip($keys));
        $intervalArrayTwo = array_intersect_key((array)$intervalTwo, array_flip($keys));

        $result = array_map(function($v1, $v2){
            return abs($v1 + $v2);
        }, $intervalArrayOne, $intervalArrayTwo);

        if($result[4] >= 60) {
            $result[3] += floor($result[4] / 60);
            $result[4] = $result[4] % 60;
        }

        return new DateInterval(vsprintf("P%dY%dM%dDT%dH%dM%dS", $result));
    }

    public function filter($filters, $options = [])
    {
        $dp = $this;
        $dp = $dp->filterId($dp, $filters);

        if(isset($filters['user_id']) && $filters['user_id'] != "")
            $dp = $dp->where('user_id', $filters['user_id']);
        if(isset($filters['place_id']) && $filters['place_id'] != "")
            $dp = $dp->where('place_id', $filters['place_id']);
        if(isset($filters['status']) && $filters['status'] != "")
            $dp = $dp->where('status', $filters['status']);
        if(isset($filters['jobtype']) && $filters['jobtype'] != "")
            $dp = $dp->where('jobtype', $filters['jobtype']);
        if(isset($filters['shift']) && $filters['shift'] != "")
            $dp = $dp->where('shift', $filters['shift']);
        
        if((!empty($filters['date_period_start']) && $filters['date_period_start'] !== '')
            || (!empty($filters['date_period_end']) && $filters['date_period_end'] !== '')) {
            if((!empty($filters['date_period_start']) && $filters['date_period_start'] !== '')
                && (!empty($filters['date_period_end']) && $filters['date_period_end'] !== '')) {
                $dp = $dp->whereBetween($this->table.'.date_period', [$filters['date_period_start'], $filters['date_period_end']]);
            } else if ((!empty($filters['date_period_start']) && $filters['date_period_start'] !== '')
                && (empty($filters['date_period_end']) && $filters['date_period_end'] == '')) {
                $dp = $this->where($this->table.'.date_period', '>=', $filters['date_period_start']);
            } else if ((empty($filters['date_period_start']) && $filters['date_period_start'] == '')
                && (!empty($filters['date_period_end']) && $filters['date_period_end'] !== '')) {
                $dp = $dp->where($this->table.'.date_period', '<=', $filters['date_period_end']);
            }
        }

        if(isset($options["notDraft"]))
            $dp = $dp->where($this->table.'.status', '<>', 'draft');

        $dp = $this->filterIsActive($dp, $filters);
        $dp = $this->filterCreatedAt($dp, $filters);
        $dp = $this->filterUpdatedAt($dp, $filters);
        $dp = $this->sortBy($dp, $options);
        $dp = $this->retrieve($dp, $options);

        return $dp;
    }

    public function parseCcMonthlyReportData($data)
    {
        $return = [
            'detail' => [
                'day' => [
                    'normal' => [
                        'duration' => new DateInterval('PT0H'),
                        'wage' => 0,
                    ],
                    'overtime' => [
                        'duration' => new DateInterval('PT0H'),
                        'wage' => 0,
                    ]
                ],
                'evening' => [
                    'normal' => [
                        'duration' => new DateInterval('PT0H'),
                        'wage' => 0,
                    ],
                    'overtime' => [
                        'duration' => new DateInterval('PT0H'),
                        'wage' => 0,
                    ]
                ],
                'overnight' => [
                    'normal' => [
                        'duration' => new DateInterval('PT0H'),
                        'wage' => 0,
                    ],
                    'overtime' => [
                        'duration' => new DateInterval('PT0H'),
                        'wage' => 0,
                    ]
                ],
            ],
            'summary' => [
                'total' => 0,
                'total_transport_fee' => 0,
                'grand_total' => 0,
            ]
        ];

        
        $relabelTypes = [
            'normal' => 'working',
            'overtime' => 'overtime',
        ];
        foreach($data as $each) {
            foreach($return['detail'] as $shift => $type) {
                $duration = $this->durationToInterval($each['actual_'.$relabelTypes['normal'].'_hour_'.$shift.'_shift']);
                $return['detail'][$shift]['normal']['duration'] = $this->addDateIntervals($return['detail'][$shift]['normal']['duration'], $duration);

                $duration = $this->durationToInterval($each['actual_'.$relabelTypes['overtime'].'_hour_'.$shift.'_shift']);
                $return['detail'][$shift]['overtime']['duration'] = $this->addDateIntervals($return['detail'][$shift]['overtime']['duration'], $duration);

                $payment_normal = $each['actual_payment_normal_'.$shift];
                $return['detail'][$shift]['normal']['wage'] += $payment_normal;

                $payment_overtime = $each['actual_payment_overtime_'.$shift];
                $return['detail'][$shift]['overtime']['wage'] += $payment_overtime;

                $return['summary']['total'] += $payment_normal + $payment_overtime;
            }
            $return['summary']['total_transport_fee'] += $each['transport_fee'];
        }

        $return['summary']['grand_total'] += $return['summary']['total'] + $return['summary']['total_transport_fee'];
        $return['detail']['day']['normal']['duration'] = $return['detail']['day']['normal']['duration']->format("%H:%I");
        $return['detail']['day']['overtime']['duration'] = $return['detail']['day']['overtime']['duration']->format("%H:%I");
        $return['detail']['evening']['normal']['duration'] = $return['detail']['evening']['normal']['duration']->format("%H:%I");
        $return['detail']['evening']['overtime']['duration'] = $return['detail']['evening']['overtime']['duration']->format("%H:%I");
        $return['detail']['overnight']['normal']['duration'] = $return['detail']['overnight']['normal']['duration']->format("%H:%I");
        $return['detail']['overnight']['overtime']['duration'] = $return['detail']['overnight']['overtime']['duration']->format("%H:%I");

        return $return;
    }
}
