<?php

namespace App\Observers;

use App\Models\Series;
use App\Services\SeriesService;

class SeriesObserver
{
    public function __construct(private readonly SeriesService $seriesService) {}

    public function created(Series $series): void
    {
        //
    }

    public function updated(Series $series): void
    {
        $this->seriesService->clearAllCache($series);
    }

    public function deleted(Series $series): void
    {
        $this->seriesService->clearAllCache($series);
    }

    public function restored(Series $series): void
    {
        //
    }

    public function forceDeleted(Series $series): void
    {
        //
    }
}
