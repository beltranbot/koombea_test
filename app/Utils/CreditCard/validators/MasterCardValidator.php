<?php

namespace App\Utils\CreditCard\validators;

class MasterCardValidator extends CreditCardValidatorAbstract
{
    protected $brandName = "MasterCard";
    protected $rules = [
        [
            "inn_ranges" => ["2221-2720", "51-55"],
            "length" => ["15"]
        ]
    ];
}