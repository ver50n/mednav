<?php

namespace App\Models;

use Validator;
use session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Place extends Model
{
    use \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;
    public $table = 'places';
    protected $guarded = [];

    public function placeHourlyWages()
    {
        return $this->hasMany(\App\Models\PlaceHourlyWage::Class);
    }

    public function placeShiftHours()
    {
        return $this->hasMany(\App\Models\PlaceShiftHour::Class);
    }

    public function add($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'name' => 'required',
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
            
            return $validator->getMessageBag()->add('name', $e->getMessage());
        }
    }

    public function edit($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'name' => 'required',
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails()) {
                return $validator;
            }

            $this->fill($data);            
            $this->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            return $validator->getMessageBag()->add('name', $e->getMessage());
        }
    }

    public function filter($filters, $options = [])
    {
        $dp = $this;
        $dp = $dp->filterId($dp, $filters);

        if(isset($filters['name']) && $filters['name'] != "")
            $dp = $dp->where('name', 'LIKE', '%'.$filters['name'].'%');
        if(isset($filters['address']) && $filters['address'] != "")
            $dp = $dp->where($this->table.'.address', 'LIKE', '%'.$filters['address'].'%');
        if(isset($filters['desc']) && $filters['desc'] != "")
            $dp = $dp->where($this->table.'.desc', 'LIKE', '%'.$filters['desc'].'%');

        $dp = $this->filterIsActive($dp, $filters);
        $dp = $this->filterCreatedAt($dp, $filters);
        $dp = $this->filterUpdatedAt($dp, $filters);
        $dp = $this->sortBy($dp, $options);
        $dp = $this->retrieve($dp, $options);

        return $dp;
    }
}
