<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\RewardProgramController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class);
Route::resource('reward-programs', RewardProgramController::class)->only(['index', 'show']);
Route::get('/search', SearchController::class)->name('search');

require __DIR__.'/auth.php';
