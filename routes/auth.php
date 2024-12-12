<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', fn () => to_route('auth'))->name('register');
    Route::get('/login', fn () => to_route('auth'))->name('login');

    Route::get('/auth', [AuthController::class, 'show'])->name('auth');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])
        ->name('logout');
});
