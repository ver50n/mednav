<?php

namespace App\Models;

use Validator;
use session;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use DB;

use \App\Utils\DateTimeInherit;
use DateTime;
use DateInterval;

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
                'day' => 'required|numeric',
                'evening' => 'required|numeric',
                'overnight' => 'required|numeric',
                'overtime_overnight' => 'required|numeric',
                'overtime' => 'required|numeric',
                'holiday' => 'required|numeric',
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
                "day" => $data["day"][$i],
                "evening" => $data["evening"][$i],
                "overnight" => $data["overnight"][$i],
                "overtime_overnight" => $data["overtime_overnight"][$i],
                "overtime" => $data["overtime"][$i],
                "holiday" => $data["holiday"][$i],
            ];
            $placeHourlyWage = new PlaceHourlyWage();
            $placeHourlyWage->add($wageData);
        }

        return true;
    }
}
