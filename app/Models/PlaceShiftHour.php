<?php

namespace App\Models;

use Validator;
use session;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use DB;

class PlaceShiftHour extends Model
{
    use \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;
    public $table = 'place_shift_hours';
    protected $guarded = [];

    public function place()
    {
        return $this->belongsTo(\App\Models\Place::Class);
    }

    public function add($data)
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
                'shift' => [
                    'required',
                    Rule::in(array_keys(\App\Helpers\ApplicationConstant::WORKING_SHIFT)),
                ],
                'start_hour' => 'required',
                'end_hour' => 'required',
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails()) {
                dd($validator->messages()->get('*'));
                return $validator;
            }
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

    public static function setPlaceShiftHours($data)
    {
        PlaceShiftHour::where(["place_id" => $data["place_id"]])->delete();
        
        for($i = 0; $i < count($data["shift"]); $i++) {
            $shiftData = [
                "place_id" => $data["place_id"],
                "shift" => $data["shift"][$i],
                "start_hour" => $data["start_hour"][$i],
                "end_hour" => $data["end_hour"][$i],
                "overlap_hour" => $data["overlap_hour"][$i],
            ];
            $placeShiftHour = new PlaceShiftHour();
            $placeShiftHour->add($shiftData);
        }

        return true;
    }

    public static function getShift($data)
    {
        $shift = null;
        $startAtTime = date('H:i:00', strtotime($data['timeStart']));

        $shifts = PlaceShiftHour::where([
            "place_id" => $data["place_id"]
        ])->orderBy('start_hour', 'asc')->get()->toArray();

        if (strtotime($startAtTime) < strtotime($shifts[0]["start_hour"]))
            $shift = end($shifts);
        else {
            foreach($shifts as $each) {
                if (strtotime($startAtTime) >= strtotime($each["start_hour"]))
                    $shift = $each;
            }
        }

        return $shift;
    }
}
