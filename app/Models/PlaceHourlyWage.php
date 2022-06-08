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
}
