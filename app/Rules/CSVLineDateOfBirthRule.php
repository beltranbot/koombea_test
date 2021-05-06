<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CSVLineDateOfBirthRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $dateInput)
    {
        $ymd = 'Ymd';
        $f = 'Y-m-d';
        $time = strtotime($dateInput);
        $check1 = $this->checkFormat($ymd, $time, $dateInput);
        $check2 = $this->checkFormat($f, $time, $dateInput);
        return $check1 || $check2;
    }

    private function checkFormat($format, $time, $dateInput)
    {
        $testDate = date($format, $time);
        return $dateInput == $testDate;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Date of birth must either be in the "Ymd" or "Y-m-d" format.';
    }
}
