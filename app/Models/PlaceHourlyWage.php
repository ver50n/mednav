<?php

namespace App\Models;

use Validator;
use session;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use DB;

class PlaceHourlyWage extends Model
{
    use \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;
    public $table = 'place_hourly_wages';
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
                'jobtype' => [
                    'required',
                    Rule::in(array_keys(\App\Helpers\ApplicationConstant::JOBTYPE)),
                ],
                'morning_wage' => 'required|numeric',
                'noon_wage' => 'required|numeric',
                'night_wage' => 'required|numeric',
                'night_overtime_wage' => 'required|numeric',
                'overtime_wage' => 'required|numeric',
                'holiday_wage' => 'required|numeric',
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

    public static function setPlaceHourlyWages($data)
    {
        PlaceHourlyWage::where(["place_id" => $data["place_id"]])->delete();
        
        for($i = 0; $i < count($data["jobtype"]); $i++) {
            $wageData = [
                "place_id" => $data["place_id"],
                "jobtype" => $data["jobtype"][$i],
                "morning_wage" => $data["morning_wage"][$i],
                "noon_wage" => $data["noon_wage"][$i],
                "night_wage" => $data["night_wage"][$i],
                "night_overtime_wage" => $data["night_overtime_wage"][$i],
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
}
