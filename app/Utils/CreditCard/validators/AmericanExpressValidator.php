<?php

namespace App\Utils\CreditCard\validators;

class AmericanExpressValidator extends CreditCardValidatorAbstract
{
    protected $brandName = "American Express";
    protected $rules = [
        [
            "inn_ranges" => ["34", "37"],
            "length" => ["15"]
        ]
    ];
}