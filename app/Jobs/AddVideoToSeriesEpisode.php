<?php

namespace App\Jobs;

use App\Models\SeriesEpisode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddVideoToSeriesEpisode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public SeriesEpisode $seriesEpisode,
        public string $filePath
    ) {}

    public function handle(): void
    {
        $this->seriesEpisode->addMediaFromDisk($this->filePath, 's3_private')
            ->toMediaCollection('video');
    }
}
