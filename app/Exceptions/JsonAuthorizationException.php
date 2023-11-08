<?php

namespace App\Exceptions;

use Exception;

class JsonAuthorizationException extends Exception
{
    public function report() {
        return false;
    }

    public function render($request) {
        return response()->json([
            'message'   =>  'No authorizado.'
        ], 403);
    }
}
