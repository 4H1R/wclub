<?php

namespace App\Http\Controllers;

use App\Data\Coupon\CouponData;
use App\Data\Series\SeriesData;
use App\Models\Coupon;
use App\Models\Scopes\PublishedScope;
use App\Settings\ScoreSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;

class DashboardController extends Controller
{
    public function show(Request $request): RedirectResponse
    {
        return to_route('dashboard.score', $request->all());
    }

    public function score(ScoreSettings $scoreSettings): \Inertia\Response
    {
        $coupons = Coupon::query()
            ->where('user_id', Auth::id())
            ->where('expired_at', '>', now())
            ->get();

        return Inertia::render('dashboard/Score', [
            'score_to_coupon_logic' => $scoreSettings->score_to_coupon_logic,
            'coupons' => CouponData::collect($coupons),
        ]);
    }

    public function series(): \Inertia\Response
    {
        $series = Auth::user()
            ->ownedSeries()
            ->withGlobalScope('published', new PublishedScope)
            ->with(['image', 'categories'])
            ->paginate();

        return Inertia::render('dashboard/Series', [
            'series' => SeriesData::collect($series, PaginatedDataCollection::class),
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
