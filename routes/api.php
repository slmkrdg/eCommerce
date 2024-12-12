<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Auth\RegisterController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);


Route::middleware('auth:api')->group(function () {
    Route::prefix('orders')->group(function () {
        Route::post('/', [OrderController::class, 'create']);
        Route::get('/', [OrderController::class, 'list']);
        Route::delete('/{id}', [OrderController::class, 'delete']);
    });
});
