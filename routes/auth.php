<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::name('login')
    ->post('login', [LoginController::class, 'login']);

Route::name('logout')
    ->middleware('auth:sanctum')
    ->post('logout', [LoginController::class, 'logout']);
