<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;

Route::name('api.')->group(function () {
    Route::post('login', LoginController::class)->name('login');
});
