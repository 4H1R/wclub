<?php

namespace App\Observers;

use App\Models\SeriesChapter;
use App\Services\SeriesService;
use Illuminate\Support\Facades\Cache;

class SeriesChapterObserver
{
    public function __construct(private readonly SeriesService $seriesService) {}

    public function created(SeriesChapter $seriesChapter): void
    {
        Cache::forget($this->seriesService->getCacheKey($seriesChapter->series));
    }

    public function updated(SeriesChapter $seriesChapter): void
    {
        Cache::forget($this->seriesService->getCacheKey($seriesChapter->series));
    }

    public function deleted(SeriesChapter $seriesChapter): void
    {
        Cache::forget($this->seriesService->getCacheKey($seriesChapter->series));
    }

    public function restored(SeriesChapter $seriesChapter): void
    {
        //
    }

    public function forceDeleted(SeriesChapter $seriesChapter): void
    {
        //
    }
}
