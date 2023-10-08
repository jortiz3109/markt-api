<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\TokenController;
use Illuminate\Support\Facades\Route;

Route::name('login')
    ->post('login', [LoginController::class, 'login']);

Route::name('logout')
    ->middleware('auth:sanctum')
    ->post('logout', [LoginController::class, 'logout']);

Route::name('token.renew')
    ->middleware('auth:sanctum')
    ->patch('/token/renew', [TokenController::class, 'renew']);
