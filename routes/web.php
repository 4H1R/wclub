<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\Contest\ContestController;
use App\Http\Controllers\Contest\ContestRegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventProgramController;
use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\Game\NardebanShadiController;
use App\Http\Controllers\Game\RollTheDiceGameController;
use App\Http\Controllers\GardenController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RewardProgramController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Series\SeriesController;
use App\Http\Controllers\Series\SeriesOwnController;
use App\Http\Controllers\SeriesEpisodeController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::get('/', IndexController::class)->name('index');
Route::get('/contact-us', [ContactUsController::class, 'create'])->name('contact-us');
Route::post('/contact-us', [ContactUsController::class, 'store'])->middleware(ProtectAgainstSpam::class);
Route::get('/about-us', AboutUsController::class)->name('about-us');
Route::get('/search', SearchController::class)->name('search');
Route::get('/chatbot', ChatbotController::class)->name('chatbot');

Route::middleware('auth')->group(function () {
    Route::resource('series.owns', SeriesOwnController::class)->only(['store']);
});

Route::resource('news', NewsController::class)->only(['index', 'show']);
Route::resource('gardens', GardenController::class)->only(['index', 'show']);
Route::resource('series', SeriesController::class);
Route::resource('series.episodes', SeriesEpisodeController::class)->only(['index', 'show'])->whereNumber('episode');
Route::resource('reward-programs', RewardProgramController::class)->only(['index', 'show']);
Route::resource('event-programs', EventProgramController::class)->only(['index', 'show']);
Route::resource('contests', ContestController::class)->only(['index', 'show']);
Route::resource('games', GameController::class)->only(['index']);
Route::get('/games/roll-the-dice', RollTheDiceGameController::class);
Route::get('/games/nardeban-shadi', NardebanShadiController::class);

Route::middleware('auth')->group(function () {
    Route::resource('contests.registrations', ContestRegistrationController::class)->only(['store']);
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
});

require __DIR__.'/auth.php';
