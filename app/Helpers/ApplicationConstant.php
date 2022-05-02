<?php
namespace App\Helpers;

use Lang;
use App\Helpers\DropdownUtils;

class ApplicationConstant
{
    const YES_NO = [
        0 => 'no',
        1 => 'yes'
    ];

    const LANGUAGE = [
        'en' => 'en',
        'ja' => 'ja',
        'id' => 'id',
    ];

    const WORKING_SHIFT = [
        'morning' => 'morning',
        'noon' => 'noon',
        'night' => 'night',

        'day' => 'day',
        'evening' => 'evening',
        'overnight' => 'overnight'
    ];

    const JOBTYPE = [
        'callcenter' => 'callcenter',
        'attendance' => 'attendance',
    ];

    const EXCEPTION_WAGE_RATE = [
        'morning' => 1,
        'noon' => 1,
        'night' => 1.25,
        'overtime' => 1.25,
        'night_overtime' => 1.5,
        'holiday' => 1.35,
    ];

    const CALLCENTER_STATUS = [
        'draft' => 'draft',
        'open' => 'open',
        'request' => 'request',
        'approved' => 'approved',
        'rejected' => 'rejected',
        'finished' => 'finished',
        'cancel' => 'cancel',
    ];

    public static function getDropdown($constant)
    {
        $return = [];
        $items = constant('self::'.$constant);

        foreach($items as $key => $value) {
            $return[$key] = \Lang::get('application-constant.'.$constant.'.'.$value);
        }

        return $return;
    }

    public static function getLabel($constant, $key)
    {
        $items = constant('self::'.$constant);

        return \Lang::get('application-constant.'.$constant.'.'.$items[$key]);
    }
}
