<?php

namespace App\Http\Controllers;

use App\Settings\ScoreSettings;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function show(): RedirectResponse
    {
        return to_route('dashboard.score');
    }

    public function score(ScoreSettings $scoreSettings): \Inertia\Response
    {
        return Inertia::render('dashboard/Score', [
            'score_to_coupon_logic' => $scoreSettings->score_to_coupon_logic,
        ]);
    }

    public function account(): \Inertia\Response
    {
        return Inertia::render('dashboard/Account');
    }

    public function orders(): \Inertia\Response
    {
        return Inertia::render('dashboard/Orders');
    }
}
