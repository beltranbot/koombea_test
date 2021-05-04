<?php

namespace App\Utils\CreditCard\validators;

class DinersClubValidator extends CreditCardValidatorAbstract
{
    protected $brandName = "Diners Club";
    protected $rules = [
        [
            "inn_ranges" => ["36"],
            "length" => ["14-19"]
        ],
        [
            "inn_ranges" => ["54"],
            "length" => ["16"]
        ]
    ];
}
