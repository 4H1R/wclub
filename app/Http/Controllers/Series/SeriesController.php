<?php

namespace App\Http\Controllers\Series;

use App\Data\Category\CategoryData;
use App\Data\Series\SeriesData;
use App\Data\Series\SeriesFullData;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Scopes\PublishedScope;
use App\Models\Series;
use App\Services\SeriesService;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SeriesController extends Controller
{
    public function __construct(private readonly SeriesService $seriesService) {}

    public function index(): \Inertia\Response
    {
        $series = QueryBuilder::for(Series::class)
            ->allowedSorts('created_at', 'updated_at', 'episodes_duration_seconds')
            ->allowedFilters(
                AllowedFilter::exact('status'),
                AllowedFilter::exact('type'),
                AllowedFilter::scope('query')
            )
            ->withGlobalScope('published', new PublishedScope)
            ->with(['image', 'categories'])
            ->paginate(15);

        $categories = Category::query()
            ->where('model', Series::class)
            ->get();

        return Inertia::render('series/Index', [
            'series' => SeriesData::collect($series, PaginatedDataCollection::class),
            'categories' => CategoryData::collect($categories),
        ]);
    }

    public function show(Series $series): \Inertia\Response
    {
        $this->seriesService->ensureSeriesIsPublished($series);

        $series = $this->seriesService->loadShowRelations($series);

        $recommendedSeries = Cache::remember($this->seriesService->getRecommendedSeriesCacheKey($series), now()->addMinutes(10), function () use ($series) {
            $series = Series::query()
                ->with(['image', 'categories'])
                ->where('id', '!=', $series->id)
                ->withGlobalScope('published', new PublishedScope)
                ->inRandomOrder()
                ->take(6)
                ->get();

            return SeriesData::collect($series);
        });

        return Inertia::render('series/Show', [
            'series' => SeriesFullData::from($series),
            'recommended_series' => $recommendedSeries,
        ]);
    }
}
