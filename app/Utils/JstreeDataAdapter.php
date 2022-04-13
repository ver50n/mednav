<?php

namespace App\Utils;

class JstreeDataAdapter
{
    public static function arrayToJsTreeJson($data, $selected = [])
    {
        $return = [];
        foreach($data as $unique => $info) {
            $checked = in_array($unique, $selected);

            $return[] = [
                'id' => $unique,
                'text' => $info['name'],
                'icon' => $info['icon'],
                'state' => [
                    'opened' => true,
                    'selected' => $checked
                ],
                'a_attr' => [
                    'data-category-id' => $info['id']
                ]
                
            ];

            if(isset($info['children']))
                $return['children'] = self::arrayToJsTreeJson($info['children'], $selected);
        }
        return $return;
    }
}
