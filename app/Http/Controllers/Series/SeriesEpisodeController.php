<?php

namespace App\Http\Controllers\Series;

use App\Data\Series\SeriesFullData;
use App\Data\SeriesEpisode\SeriesEpisodeFullData;
use App\Http\Controllers\Controller;
use App\Http\Middleware\FixSlugMiddleware;
use App\Models\Series;
use App\Models\SeriesChapter;
use App\Services\SeriesService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;

class SeriesEpisodeController extends Controller implements HasMiddleware
{
    public function __construct(
        private readonly SeriesService $seriesService,
    ) {}

    public static function middleware(): array
    {
        return [
            new Middleware(FixSlugMiddleware::class, only: ['show']),
        ];
    }

    public function index(Series $series): RedirectResponse
    {
        return to_route('series.show', [$series]);
    }

    public function show(Series $series, int $episode): \Inertia\Response
    {
        abort_if($episode <= 0, 404);

        $series = $this->seriesService->loadShowRelations($series);

        $episodeModel = $series->chapters
            ->flatMap(fn (SeriesChapter $chapter) => $chapter->episodes)
            ->get($episode - 1);

        abort_unless($episodeModel, 404);

        $episodeModel->load(['video']);

        return Inertia::render('series/episodes/Show', [
            'series' => SeriesFullData::from($series),
            'current_episode' => SeriesEpisodeFullData::from([
                ...$episodeModel->toArray(),
                'episode_number' => $episode,
                'video' => $this->seriesService->getEpisodeVideoData($series->is_owned, $episodeModel),
            ]),
        ]);
    }
}
