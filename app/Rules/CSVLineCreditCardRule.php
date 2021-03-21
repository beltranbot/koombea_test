<?php

namespace App\Rules;

use App\Utils\CreditCardFactory;
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
        $brand = CreditCardFactory::getBrand($value);
        return $brand !== false;
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
