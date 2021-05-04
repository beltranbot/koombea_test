<?php

namespace App\Utils\CreditCard\validators;

class VisaValidator extends CreditCardValidatorAbstract
{
    protected $brandName = "Visa";
    protected $rules = [
        [
            "inn_ranges" => ["4"],
            "length" => ["13", "16"]
        ]
    ];
}