<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;

class LoginFailedException extends Exception
{
    public function render(): void
    {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
}
