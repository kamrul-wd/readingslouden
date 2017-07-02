<?php

namespace App\Http\Validators;

use Input;
use Illuminate\Validation\Validator;

class FileValidator extends Validator
{
    public function validateValidMimeTypes($attribute, $value, $parameters, $translator)
    {
        $allowed_mimes = [
            // pdf
            'application/pdf',
            // doc
            'application/msword',
            // docx
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            // xls
            'application/vnd.ms-excel',
            'application/excel',
            'application/x-excel',
            'application/x-msexcel',
            // xlsx
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            // txt
            'text/plain',
            // zip
            'application/zip',
        ];

        return in_array(Input::file($attribute)->getMimeType(), $allowed_mimes);
    }
}
