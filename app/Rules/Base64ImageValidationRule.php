<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Base64ImageValidationRule implements Rule
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
        $data = base64_decode($value);
        $finfo = finfo_open();
        $mime_type = finfo_buffer($finfo, $data, FILEINFO_MIME_TYPE);
        $valid_image_types = ['image/jpeg', 'image/png', 'image/gif'];
        finfo_close($finfo);

        return in_array($mime_type, $valid_image_types);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid image encoded in base64 format.';
    }
}
