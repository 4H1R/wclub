<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\Contest\ContestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventProgramController;
use App\Http\Controllers\GardenController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RewardProgramController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Series\SeriesController;
use App\Http\Controllers\Series\SeriesOwnController;
use App\Http\Controllers\SeriesEpisodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::get('/contact-us', [ContactUsController::class, 'create'])->name('contactUs');
Route::post('/contact-us', [ContactUsController::class, 'store']);
Route::get('/about-us', AboutUsController::class)->name('aboutUs');
Route::get('/search', SearchController::class)->name('search');

Route::middleware('auth')->group(function () {
    Route::resource('series.owns', SeriesOwnController::class)->only(['store']);
});

Route::resource('gardens', GardenController::class)->only(['index', 'show']);
Route::resource('series', SeriesController::class);
Route::resource('series.episodes', SeriesEpisodeController::class)->only(['index', 'show'])->whereNumber('episode');
Route::resource('reward-programs', RewardProgramController::class)->only(['index', 'show']);
Route::resource('event-programs', EventProgramController::class)->only(['index', 'show']);
Route::resource('contests', ContestController::class)->only(['index', 'show']);
Route::resource('contests.registrations', ContestController::class)->only(['store']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
});

require __DIR__.'/auth.php';
