<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NidNumberLength implements Rule
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
        $length = strlen($value);
        return $length === 10 || $length === 17;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be either 10 or 17 digits.';
    }
}
