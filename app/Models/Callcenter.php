<?php

namespace App\Models;

use Validator;
use session;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
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
                'shift' => [
                    'required',
                    Rule::in(array_keys(\App\Helpers\ApplicationConstant::WORKING_SHIFT)),
                ],
                'time_start' => 'required|date_format:Y-m-d H:i',
                'time_end' => 'required|date_format:Y-m-d H:i',
                'working_hour' => 'required',
                'actual_time_start' => 'required|date_format:Y-m-d H:i',
                'actual_time_end' => 'required|date_format:Y-m-d H:i',
                'actual_time_rest' => 'required|date_format:H:i',
                'handling_fee' => 'required|numeric',
                'transport_fee' => 'required|numeric',
                'actual_working_hour' => 'required',
                'actual_overtime_start' => 'required',
                'actual_overtime_end' => 'required',
                'actual_overtime' => 'required',
                'normal_wage' => 'required|numeric',
                'night_wage' => 'required|numeric',
                'late_night_wage' => 'required|numeric',
                'overtime_wage' => 'required|numeric',
                'holiday_wage' => 'required|numeric',
                'user_payment' => 'required|numeric',
                'actual_payment' => 'required|numeric',
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails()){
                return $validator;
            }
            $this->fill($data);
            $this->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            dd($e->getMessage());
            return $validator->getMessageBag()->add('user_id', $e->getMessage());
        }
    }

    public function edit($data)
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
                'shift' => [
                    'required',
                    Rule::in(array_keys(\App\Helpers\ApplicationConstant::WORKING_SHIFT)),
                ],
                'time_start' => 'required|date_format:Y-m-d H:i',
                'time_end' => 'required|date_format:Y-m-d H:i',
                'working_hour' => 'required',
                'actual_time_start' => 'required|date_format:Y-m-d H:i',
                'actual_time_end' => 'required|date_format:Y-m-d H:i',
                'actual_time_rest' => 'required',
                'handling_fee' => 'required|numeric',
                'transport_fee' => 'required|numeric',
                'actual_working_hour' => 'required',
                'actual_overtime_start' => 'required',
                'actual_overtime_end' => 'required',
                'actual_overtime' => 'required',
                'normal_wage' => 'required|numeric',
                'night_wage' => 'required|numeric',
                'late_night_wage' => 'required|numeric',
                'overtime_wage' => 'required|numeric',
                'holiday_wage' => 'required|numeric',
                'user_payment' => 'required|numeric',
                'actual_payment' => 'required|numeric',
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails())
                return $validator;
            $this->fill($data);
            $this->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            return $validator->getMessageBag()->add('user_id', $e->getMessage());
        }
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

        $dp = $this->filterIsActive($dp, $filters);
        $dp = $this->filterCreatedAt($dp, $filters);
        $dp = $this->filterUpdatedAt($dp, $filters);
        $dp = $this->sortBy($dp, $options);
        $dp = $this->retrieve($dp, $options);

        return $dp;
    }
}
