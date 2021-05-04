<?php

namespace App\Utils;

class CreditCardFactory
{
    static $rules = [
        'American Express' => [
            [
                'inn_ranges' => ['34', '37'],
                'length' => ['15']
            ]
        ],
        'Diners Club' => [
            [
                'inn_ranges' => ['36'],
                'length' => ['14-19']
            ],
            [
                'inn_ranges' => ['54'],
                'length' => ['16']
            ]
        ],
        'Discover Card' => [
            [
                'inn_ranges' => ['6011', '622126-622925', '644', '645', '646', '647', '648', '649', '65'],
                'length' => ['16-19']
            ]
        ],
        'JCB' => [
            [
                'inn_ranges' => ['3528-3589'],
                'length' => ['16-19']
            ]
        ],
        'MasterCard' => [
            [
                'inn_ranges' => ['2221-2720', '51-55'],
                'length' => ['15']
            ]
        ],
        'Visa' => [
            [
                'inn_ranges' => ['4'],
                'length' => ['13', '16']
            ]
        ]
    ];

    public static function getBrand($number)
    {
        if (!self::areAllNumbers($number)) {
            return false;
        }
        foreach (static::$rules as $brand => $brandRules) {
            foreach ($brandRules as $rule) {
                foreach ($rule['length'] as $length) {
                    if (!self::checkLength($number, $length)) {
                        continue;
                    }
                    foreach ($rule['inn_ranges'] as $range) {
                        if (!self::checkInnRange($number, $range)) {
                            continue;
                        }
                        return $brand;
                    }
                }
            }
        }
        return false;
    }

    private static function areAllNumbers($number)
    {
        $numbers = str_split($number);
        foreach ($numbers as $item) {
            if (!is_numeric($item)) {
                return false;
            }
        }
        return true;
    }

    private static function checkLength($number, $length)
    {
        if (is_numeric($length)) {
            return strlen($number) === intval($length);
        }
        $arr = explode('-' , $length);
        return strlen($number) >= intval($arr[0]) && strlen($number) <= intval($arr[1]);
    }

    private static function checkInnRange($number, $range)
    {
        if (is_numeric($range)) {
            return str_starts_with($number, $range);
        }
        $arr = explode('-' , $range);
        $strStart = substr($number, 0, strlen($arr[0]));
        return intval($strStart) >= intval($arr[0]) && intval($strStart) <= intval($arr[1]);
    }
}
