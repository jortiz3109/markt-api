<?php

use App\Http\Controllers\ShoppingListController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json(['message' => 'Success from octane, minikube, ingress and kubernetes!']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::name('user.')->prefix('user')->group(function () {
        Route::name('info')->get(uri: 'info', action: function () {
            return response()->json(['user' => auth()->user()->only(['name', 'email'])]);
        });
    });

    Route::name('shopping-lists.')->prefix('shopping-lists')->group(function () {
        Route::name('index')->get('/', [ShoppingListController::class, 'index']);
    });
});
