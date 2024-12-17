<?php

namespace App\Observers;

use App\Jobs\CalculateSeriesData;
use App\Models\SeriesEpisode;

class SeriesEpisodeObserver
{
    public function created(SeriesEpisode $seriesEpisode): void
    {
        CalculateSeriesData::dispatch($seriesEpisode->series);
    }

    public function updated(SeriesEpisode $seriesEpisode): void
    {
        CalculateSeriesData::dispatch($seriesEpisode->series);
    }

    public function deleted(SeriesEpisode $seriesEpisode): void
    {
        CalculateSeriesData::dispatch($seriesEpisode->series);
    }

    public function restored(SeriesEpisode $seriesEpisode): void
    {
        //
    }

    public function forceDeleted(SeriesEpisode $seriesEpisode): void
    {
        //
    }
}
