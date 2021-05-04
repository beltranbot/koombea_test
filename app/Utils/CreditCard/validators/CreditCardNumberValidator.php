<?php

namespace App\Utils\CreditCard\validators;

use App\Utils\CreditCard\Validators\DiscoveryCardValidator;

class CreditCardNumberValidator
{
    private $creditCardValidators = [];
    private $isValid = false;
    private $validator;
    private $number;

    public function __construct($number)
    {
        $this->number = $number;
        $this->loadCreditCardValidators();
        $this->isValid = $this->getValidator();
    }

    public function isValid()
    {
        return $this->isValid;
    }

    public function getBrand()
    {
        if ($this->isValid()) {
            return $this->validator->getBrand();
        }
        return false;
    }

    private function getValidator()
    {
        foreach ($this->creditCardValidators as $validatorClass) {
            $validator = new $validatorClass($this->number);
            if ($validator->isValid()) {
                $this->validator = $validator;
                return true;
            }
        }
        return false;
    }

    private function loadCreditCardValidators()
    {
        $this->creditCardValidators = [
            AmericanExpressValidator::class,
            DinersClubValidator::class,
            DiscoveryCardValidator::class,
            JCBValidator::class,
            MasterCardValidator::class,
            VisaValidator::class
        ];
    }
}