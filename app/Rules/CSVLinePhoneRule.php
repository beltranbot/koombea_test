<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CSVLinePhoneRule implements Rule
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
    public function passes($attribute, $value)
    {
        $check1 = preg_match("/^\(\+\d{2}\)\s\d{3}\s\d{3}\s\d{2}\s\d{2}$/", $value);
        $check2 = preg_match("/^\(\+\d{2}\)\s\d{3}\-\d{3}\-\d{2}\-\d{2}$/", $value);
        return $check1 || $check2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Phone must be in the "(+00) 000 000 00 00" or "(+00) 000-000-00-00" formats.';
    }
}
