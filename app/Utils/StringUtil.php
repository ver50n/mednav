<?php

namespace App\Utils;

class StringUtil
{

    public static function convertCamelToSnakeCase($str)
    {
        return strtolower(preg_replace('/(?<!^)([A-Z])/', '_$1', $str));
    }
    
    public static function convertSnakeToCamelCase($str)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $str))));
    }
    
    public static function replaceTemplateVariable($string, $params)
    {
        foreach($params as $param => $value) {
            if(!is_string($value))
                continue;
                
            $search = '%'.$param.'%';
            $string = str_replace($search, $value, $string);
        }
        return $string;
    }

    public static function uniqueSlug($value = null)
    {
        $value = ($value) ? $value : env('HASH_KEY');
        $conversion = unpack('H*', $value);
        return round(microtime(true) * 1000).$conversion[1];
    }

    public static function encrypt($value)
    {
        return \Crypt::encrypt($value);
    }

    public static function decrypt($value)
    {
        return \Crypt::decrypt($value);
    }
}