<?php
namespace App\Utils;

use App\Helpers\ApplicationConstant;

class DataFormatterUtil
{
    public static function defaultValueFormatter($key, $value)
    {
        $return = $value;
        switch($key) {
            case 'admin_type':
                $return = ApplicationConstant::ADMIN_TYPE[$value];
                break;
            case 'is_active':
                $return = ApplicationConstant::YES_NO[$value];
                break;
            case 'created_at':
                $return = \App\Helpers\DateUtil::dateTimeFormatter($value);
                break;
            case 'updated_at':
                $return = \App\Helpers\DateUtil::dateTimeFormatter($value);
                break;
        }

        return $return;
    }
}
