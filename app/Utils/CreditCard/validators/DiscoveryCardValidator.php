<?php

namespace App\Utils\CreditCard\Validators;

use App\Utils\CreditCard\validators\CreditCardValidatorAbstract;

class DiscoveryCardValidator extends CreditCardValidatorAbstract
{
    protected $brandName = "Discovery Card";
    protected $rules = [
        [
            "inn_ranges" => ["6011", "622126-622925", "644", "645", "646", "647", "648", "649", "65"],
            "length" => ["16-19"]
        ]
    ];
}