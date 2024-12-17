<?php

namespace App\Jobs;

use App\Models\Series;
use App\Services\SeriesService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class CalculateSeriesData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Series $series)
    {
        //
    }

    public function handle(): void
    {
        $episodeDuration = $this->series->episodes()->sum('video_duration_seconds');

        $this->series->update(['episodes_duration_seconds' => $episodeDuration]);

        Cache::forget(app(SeriesService::class)->getCacheKey($this->series));
    }
}
