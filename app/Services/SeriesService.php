<?php

namespace App\Services;

use App\Data\Media\VideoData;
use App\Models\Media;
use App\Models\Scopes\PublishedScope;
use App\Models\Series;
use App\Models\SeriesEpisode;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SeriesService
{
    const REVIEWS_PER_PAGE = 20;

    const COMMENTS_PER_PAGE = 10;

    const TEMP_URL_HOURS = 5;

    public function loadShowRelations(Series $series): Series
    {
        $cachedSeries = Cache::remember($this->getCacheKey($series), now()->addMinutes(10), function () use ($series) {
            $series->loadCount('episodes', 'ownedUsers');
            $series->load([
                'image',
                'categories',
                'chapters' => fn (HasMany $builder) => $builder
                    ->ordered()
                    ->withGlobalScope('published', new PublishedScope)
                    ->with([
                        'episodes' => fn (HasMany $nestedBuilder) => $nestedBuilder
                            ->withGlobalScope('published', new PublishedScope)
                            ->ordered(),
                    ]),
            ]);

            return $series;
        });

        $cachedSeries->is_owned = $this->isOwned($series);

        return $cachedSeries;
    }

    public function isOwned(Series $series): bool
    {
        if (Auth::guest()) {
            return false;
        }

        return $series->ownedUsers()->where('user_id', Auth::id())->exists();
    }

    public function getEpisodeVideoData(bool $hasBoughtSeries, SeriesEpisode $episode): ?VideoData
    {
        /** @var Media $video */
        $video = $episode->video;

        if (! $video) {
            return null;
        }

        $url = null;

        if ($hasBoughtSeries) {
            $url = $video->getTemporaryUrl(now()->addHours(SeriesService::TEMP_URL_HOURS));
        }

        return VideoData::from([
            ...$video->toArray(),
            'url' => $url,
        ]);
    }

    public function ensureSeriesIsPublished(Series $series): void
    {
        abort_unless($series->published_at, 404);
    }

    public function getCacheKey(Series $series)
    {
        return 'series#'.$series->id;
    }

    public function getReviewsCacheKey(Series $series)
    {
        return 'series.reviews#'.$series->id;
    }

    public function getRecommendedSeriesCacheKey(Series $series)
    {
        return 'series.recommended#'.$series->id;
    }

    public function clearAllCache(Series $series): void
    {
        Cache::forget($this->getCacheKey($series));
        Cache::forget($this->getReviewsCacheKey($series));
        Cache::forget($this->getRecommendedSeriesCacheKey($series));
    }
}
