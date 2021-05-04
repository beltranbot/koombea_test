<?php
namespace App\Utils\CreditCard\validators;

use App\Utils\CreditCard\validators\exceptions\NoBrandNameException;
use App\Utils\CreditCard\validators\exceptions\NoRulesException;

abstract class CreditCardValidatorAbstract
{
    protected $brandName;
    protected $rules;
    protected $number;
    protected $isValid = false;

    public function __construct(string $number)
    {
        if (!isset($brandName)) {
            throw new NoBrandNameException();
        }
        if (!isset($rules)) {
            throw new NoRulesException();
        }
        $this->number = $number;
        $this->isValid = $this->processNumber();
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function isValid()
    {
        return $this->isValid;
    }

    public function getBrand()
    {
        return $this->brandName;
    }

    protected function processNumber()
    {
        if (!$this->areAllNumbers()) {
            return false;
        }
        return $this->processRules();
    }

    protected function processRules()
    {
        foreach ($this->rules as $rule) {
            foreach ($rule["length"] as $length) {
                if (!$this->checkLength($this->number, $length)) {
                    continue;
                }
                foreach ($rule['inn_ranges'] as $range) {
                    if (!$this->checkInnRange($this->number, $range)) {
                        continue;
                    }
                    return true;
                }
            }
        }
        return false;
    }

    protected function areAllNumbers()
    {
        $numbers = str_split($this->number);
        foreach ($numbers as $item) {
            if (!is_numeric($item)) {
                return false;
            }
        }
        return true;
    }

    protected function checkLength($number, $length)
    {
        if (is_numeric($length)) {
            return strlen($number) === intval($length);
        }
        $arr = explode('-' , $length);
        return strlen($number) >= intval($arr[0]) && strlen($number) <= intval($arr[1]);
    }

    protected function checkInnRange($number, $range)
    {
        if (is_numeric($range)) {
            return str_starts_with($number, $range);
        }
        $arr = explode('-' , $range);
        $strStart = substr($number, 0, strlen($arr[0]));
        return intval($strStart) >= intval($arr[0]) && intval($strStart) <= intval($arr[1]);
    }
}