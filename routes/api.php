<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\Auth\LoginController;

Route::name('api.')->group(function () {
    Route::post('login', LoginController::class)->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('contacts', ContactController::class);
    });
});
