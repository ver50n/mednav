<?php
namespace App\Utils;

class NumberUtil
{
    const CURRENCY = [
      'prefix'=> [
          'JPY' => '¥',
          'USD' => '$',
          'TWD' => 'NT$'
      ],
    ];

    /**
    * currency converter.
    *
    * @param integer   $nominal    nominal
    * @param string    $currency   currency that wanted to print, default JPY
    * @param array     $options    optional params
    *
    * @return string   formatted nominal
    *
    */
    public static function currencyFormat($nominal, $currency = 'JPY', $options = [])
    {
        $defaultOptions = [
            'number_separator' => ',',
            'decimal_format' => '.',
            'decimal_place' => 0,
            'operator' => '',
        ];
        $mergedOptions = array_merge(
            $defaultOptions,
            $options
        );
        $nominal = self::numberFormat($nominal, $mergedOptions);
        $nominal = self::CURRENCY['prefix'][$currency].' '.$mergedOptions['operator'].' '.$nominal;

        return $nominal;
    }
    /**
     * number Formatter.
     *
     * @param integer   $nominal    nominal
     * @param array     $options    optional params
     *
     * @return string   formatted nominal
     *
     */

    public static function numberFormat($nominal, $options = [])
    {
        $defaultOptions = [
            'number_separator' => ',',
            'decimal_format' => '.',
            'decimal_place' => 0,
            'operator' => '',
        ];

        $mergedOptions = array_merge(
            $defaultOptions,
            $options
        );

        $nominal = number_format(
            $nominal,
            $mergedOptions['decimal_place'],
            $mergedOptions['decimal_format'],
            $mergedOptions['number_separator']
        );

        return $nominal;
    }

    public static function decimalFormat($nominal, $options = [])
    {
        $defaultOptions = [
            'number_separator' => ',',
            'decimal_format' => '.',
            'decimal_place' => 2,
            'operator' => '',
        ];

        $mergedOptions = array_merge(
            $defaultOptions,
            $options
        );

        $nominal = number_format(
            $nominal,
            $mergedOptions['decimal_place'],
            $mergedOptions['decimal_format'],
            $mergedOptions['number_separator']
        );

        return $nominal;
    }

}
