<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NotJsonRequestException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json(
            data: ['message' => 'Your request should only accepts json responses'],
            status: Response::HTTP_BAD_REQUEST,
            headers: ['Content-Type' => 'application/json']
        );
    }
}
