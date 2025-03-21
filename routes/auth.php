<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\MyIsfahanController;
use App\Http\Controllers\Auth\SmsController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', fn () => to_route('auth'))->name('register');
    Route::get('/login', fn () => to_route('auth'))->name('login');

    Route::get('/auth/my-isfahan', [MyIsfahanController::class, 'redirect'])
        ->name('auth.my-isfahan');

    Route::get('/auth/my-isfahan/callback', [MyIsfahanController::class, 'callback']);

    Route::get('/auth', [AuthController::class, 'show'])
        ->name('auth');

    Route::post('/auth/sms', [SmsController::class, 'send'])
        ->name('sms.send');

    Route::post('/auth/sms/verify', [SmsController::class, 'verify'])
        ->name('sms.verify');

    Route::post('/auth/sms/register', [SmsController::class, 'register'])
        ->name('sms.register');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])
        ->name('logout');
});
