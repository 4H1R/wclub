<?php

namespace App\Http\Controllers;

use App\Data\Series\SeriesFullData;
use App\Data\SeriesEpisode\SeriesEpisodeFullData;
use App\Models\Series;
use App\Models\SeriesChapter;
use App\Services\SeriesService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class SeriesEpisodeController extends Controller
{
    public function __construct(
        private readonly SeriesService $seriesService,
    ) {}

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
