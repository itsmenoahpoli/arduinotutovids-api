<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StorageController;

Route::get('/', function () {
    return response()->json(['status' => 'online'], 200);
});

/**
 * Storage files server
 */
Route::get('/storage', [StorageController::class, 'getFileFromStorage'])->name('storage.get-file');
