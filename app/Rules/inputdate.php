<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class inputdate implements Rule
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
        // testing that dateinput is dd-mm-yyyy format
        return !! preg_match("#^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$#", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Date format must be like '.date('d-m-Y');
    }
}
