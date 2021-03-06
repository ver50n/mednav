<?php

namespace App\Models;

use DB;
use Validator;
use session;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;

    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function add($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'username' => 'required|unique:users',
                'email' => 'required|unique:users|email',
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password',
            ];
                
            $validator = Validator::make($data, $rules);

            if($validator->fails()) {
                return $validator;
            }

            $this->fill($data);
            
            $this->password = bcrypt($this->password);
            unset($this->confirm_password);
            $this->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            \Log::error($e->getMessage());
            return $validator->getMessageBag()->add('password', $e->getMessage());
        }
    }

    public function edit($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'email' => 'required|email|unique:users,email,'.$this->id,
            ];

            if($this->isDirty('password')) {
                $rules['password'] = 'required|min:6';
                $rules['confirm_password'] = 'required|same:password';
            }

            $validator = Validator::make($data, $rules);
            if($validator->fails())
                return $validator;

            $this->fill($data);
            if ($this->isDirty('password'))
                $this->password = bcrypt($this->password);
            unset($this->confirm_password);
            $this->save();
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            return $validator->getMessageBag()->add('password', $e->getMessage());
        }
    }

    public function resetPassword()
    {
        $this->password = bcrypt('staff123');
        $this->save();
    }


    public function changePassword($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'password' => 'required|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'required'
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails())
                return $validator;

            $this->password = bcrypt($data['password']);
            $this->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            return $validator->getMessageBag()->add('password', $e->getMessage());
        }
    }

    public function filter($filters, $options = [])
    {
        $dp = $this;
        $dp = $dp->filterId($dp, $filters);

        if(isset($filters['name']) && $filters['name'] != "")
            $dp = $dp->where('name', 'LIKE', '%'.$filters['name'].'%');
        if(isset($filters['email']) && $filters['name'] != "")
            $dp = $dp->where('email', 'LIKE', '%'.$filters['email'].'%');
        if(isset($filters['username']) && $filters['username'] != "")
            $dp = $dp->where('username', 'LIKE', '%'.$filters['username'].'%');
        if(isset($filters['phone']) && $filters['phone'] != "")
            $dp = $dp->where('phone', 'LIKE', '%'.$filters['phone'].'%');
        if(isset($filters['is_outsource']) && $filters['is_outsource'] != "")
            $dp = $dp->where('is_outsource', '=', $filters['is_outsource']);
        if(isset($filters['outsource_name']) && $filters['outsource_name'] != "")
            $dp = $dp->where('outsource_name', 'LIKE', '%'.$filters['outsource_name'].'%');

        $dp = $this->filterIsActive($dp, $filters);
        $dp = $this->filterCreatedAt($dp, $filters);
        $dp = $this->filterUpdatedAt($dp, $filters);
        $dp = $this->sortBy($dp, $options);
        $dp = $this->retrieve($dp, $options);

        return $dp;
    }
}
