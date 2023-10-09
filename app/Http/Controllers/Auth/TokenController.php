<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TokenController extends Controller
{
    public function renew(): JsonResponse
    {
        $expiresAt = Carbon::now()->addMinutes(config('sanctum.lifetime'));

        Auth::user()
            ->currentAccessToken()
            ->update(['expires_at' => $expiresAt]);

        return response()->json(
            data: ['message' => 'Success', 'data' => ['expires_at' => $expiresAt]],
            status: Response::HTTP_OK
        );
    }
}
