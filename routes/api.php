<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VideosController;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login'])->name('auth.login');

        Route::middleware(['auth:sanctum'])->group(function() {
            Route::get('me', [AuthController::class, 'me'])->name('auth.profile');
        });
    });

   Route::apiResources([
       'videos' => VideosController::class,
   ]);
});

