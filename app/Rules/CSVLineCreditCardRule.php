<?php

namespace App\Rules;

use App\Utils\CreditCard\validators\CreditCardNumberValidator;
use Illuminate\Contracts\Validation\Rule;

class CSVLineCreditCardRule implements Rule
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
        $creditCardNumberValidator = new CreditCardNumberValidator($value);
        return $creditCardNumberValidator->isValid();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Credit card number is not valid.';
    }
}
