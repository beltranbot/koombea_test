<?php

namespace App\Utils\CreditCard\validators;

class JCBValidator extends CreditCardValidatorAbstract
{
    protected $brandName = "JCB";
    protected $rules = [
        [
            "inn_ranges" => ["3528-3589"],
            "length" => ["16-19"]
        ]
    ];
}