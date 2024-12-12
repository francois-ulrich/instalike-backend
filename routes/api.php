<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\JwtMiddleware;

Route::prefix('auth')->group(function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware([JwtMiddleware::class])->group(function () {
        Route::get('/hello', function () { return 'Hello World'; });

        // Auth
        Route::get('user', [AuthController::class, 'getUser']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

Route::group([JwtMiddleware::class], function ($router) {
    Route::get('/hello', function () { return 'Hello World !!'; });

    // User
        Route::get('user', [AuthController::class, 'getUser']);
        Route::put('logout', [AuthController::class, 'logout']);
});
