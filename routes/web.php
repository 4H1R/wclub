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
use App\Http\Controllers\Me\ScoreController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RewardProgramController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Series\SeriesController;
use App\Http\Controllers\Series\SeriesEpisodeController;
use App\Http\Controllers\Series\SeriesOwnController;
use App\Http\Middleware\DisableInertiaSSR;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::get('/contact-us', [ContactUsController::class, 'create'])->name('contact-us');
Route::post('/contact-us', [ContactUsController::class, 'store']);
Route::get('/about-us', AboutUsController::class)->name('about-us');
Route::get('/search', SearchController::class)->name('search');
Route::get('/chatbot', ChatbotController::class)->name('chatbot');

Route::resource('news', NewsController::class)->only(['index', 'show']);
Route::resource('gardens', GardenController::class)->only(['index', 'show']);
Route::resource('series', SeriesController::class);
Route::resource('series.episodes', SeriesEpisodeController::class)->only(['index', 'show'])->whereNumber('episode');
Route::resource('reward-programs', RewardProgramController::class)->only(['index', 'show']);
Route::resource('event-programs', EventProgramController::class)->only(['index', 'show']);
Route::resource('contests', ContestController::class)->only(['index', 'show']);
Route::resource('games', GameController::class)->only(['index']);
Route::get('/games/nardeban-shadi', NardebanShadiController::class)->name('games.nardeban-shadi');
Route::get('/games/roll-the-dice', RollTheDiceGameController::class)->name('games.roll-the-dice');

Route::middleware(['auth', DisableInertiaSSR::class])->group(function () {
    Route::resource('contests.registrations', ContestRegistrationController::class)->only(['store']);
    Route::resource('series.owns', SeriesOwnController::class)->only(['store']);

    Route::prefix('/me')->name('me.')->group(function () {
        Route::post('/score/convert-to-coupon', [ScoreController::class, 'convertToCoupon'])->name('score.convert-to-coupon');
        Route::post('/score/transfer-to-my-isfahan', [ScoreController::class, 'transferToMyIsfahan'])->name('score.transfer-to-my-isfahan');
    });

    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/dashboard/score', [DashboardController::class, 'score'])->name('dashboard.score');
    Route::get('/dashboard/account', [DashboardController::class, 'account'])->name('dashboard.account');
    Route::get('/dashboard/orders', [DashboardController::class, 'orders'])->name('dashboard.orders');
});

require __DIR__.'/auth.php';
