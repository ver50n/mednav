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
    protected $guarded = [];

    public function register($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'user_id' => [
                    'required',
                    Rule::exists('users')->where(function ($query) {
                        return $query->where('is_active', 1);
                    }),
                ],
                'place_id' => [
                    'required',
                    Rule::exists('places')->where(function ($query) {
                        return $query->where('is_active', 1);
                    }),
                ],
                'date_period' => 'required|date',
                'shift' => 'required',
                'time_start' => 'required',
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

    public function edit($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$this->id,
                'password' => 'required_with:confirm_password|same:confirm_password',
                'confirm_password' => ''
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

        if(isset($filters['name']) && $filters['name'] != "")
            $dp = $dp->where('name', 'LIKE', '%'.$filters['name'].'%');

        if(isset($filters['email']) && $filters['email'] != "")
            $dp = $dp->where($this->table.'.email', 'LIKE', '%'.$filters['email'].'%');

        $dp = $this->filterIsActive($dp, $filters);
        $dp = $this->filterCreatedAt($dp, $filters);
        $dp = $this->filterUpdatedAt($dp, $filters);
        $dp = $this->sortBy($dp, $options);
        $dp = $this->retrieve($dp, $options);

        return $dp;
    }
}
