<?php

namespace App\Exceptions;

use Exception;
use \Illuminate\Contracts\Validation\Validator;

class JsonValidationException extends Exception
{
    protected $validator;

    public function __construct(Validator $validator) {
        $this->validator = $validator;
    }

    public function report() {
        return false;
    }

    public function render($request) {
        return response()->json([
            'message'   => 'Validation error',
            'error'     => $this->validator->errors()
        ], 422);
    }

}
