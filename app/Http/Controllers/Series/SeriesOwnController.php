<?php

namespace App\Http\Controllers\Series;

use App\Enums\PaymentTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Series;
use App\Services\SeriesService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SeriesOwnController extends Controller
{
    public function __construct(private readonly SeriesService $seriesService) {}

    public function store(Series $series): RedirectResponse
    {
        $this->seriesService->ensureSeriesIsPublished($series);

        abort_if($series->payment_type !== PaymentTypeEnum::Free, 403);

        Auth::user()->ownedSeries()->syncWithoutDetaching([$series->id]);

        Cache::forget($this->seriesService->getCacheKey($series));

        return back();
    }
}
