<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\LoginFailedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class LoginController extends Controller
{
    /**
     * @throws Throwable
     */
    public function login(LoginRequest $request): JsonResponse
    {
        throw_if(
            condition: false === Auth::attempt($request->validated()),
            exception: LoginFailedException::class
        );

        $user = User::select('id', 'email', 'name')
            ->where('email', $request->input('email'))
            ->first();

        $expiresAt = Carbon::now()->addMinutes(config('sanctum.lifetime'));

        return response()->json([
            'token' => $user->createToken(
                name: 'web_app',
                ipAddress: $request->ip(),
                expiresAt: $expiresAt
            )->plainTextToken,
            'expires_at' => $expiresAt,
            'user' => $user->only(['name', 'email'])
        ]);
    }

    public function logout(): JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json(data: ['message' => 'Success'], status: Response::HTTP_OK);
    }
}
