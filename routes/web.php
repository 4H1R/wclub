<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\EventProgramController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RewardProgramController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::get('/contact-us', ContactUsController::class)->name('contactUs');
Route::get('/about-us', AboutUsController::class)->name('aboutUs');
Route::get('/search', SearchController::class)->name('search');

Route::resource('series', SeriesController::class);
Route::resource('reward-programs', RewardProgramController::class)->only(['index', 'show']);
Route::resource('contests', ContestController::class)->only(['index', 'show']);
Route::resource('campaigns', CampaignController::class)->only(['index', 'show']);
Route::resource('event-programs', EventProgramController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';
