<?php

namespace App\Http\Controllers\Series;

use App\Data\Category\CategoryData;
use App\Data\Series\SeriesData;
use App\Data\Series\SeriesFullData;
use App\Data\TargetGroup\TargetGroupData;
use App\Http\Controllers\Controller;
use App\Http\Middleware\FixSlugMiddleware;
use App\Models\Category;
use App\Models\Scopes\PublishedScope;
use App\Models\Series;
use App\Models\TargetGroup;
use App\Services\SeriesService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SeriesController extends Controller implements HasMiddleware
{
    public function __construct(private readonly SeriesService $seriesService) {}

    public static function middleware(): array
    {
        return [
            new Middleware(FixSlugMiddleware::class, only: ['show']),
        ];
    }

    public function index(): \Inertia\Response
    {
        $series = QueryBuilder::for(Series::class)
            ->allowedSorts('created_at', 'updated_at', 'episodes_duration_seconds')
            ->allowedFilters(
                AllowedFilter::exact('status'),
                AllowedFilter::exact('type'),
                AllowedFilter::scope('query'),
                AllowedFilter::callback('categories_id', function (Builder $query, array $ids) {
                    $query->whereHas('categories', fn (Builder $builder) => $builder->whereIn('category_id', $ids));
                }),
                AllowedFilter::callback('target_groups_id', function (Builder $query, array $ids) {
                    $query->whereHas('targetGroups', fn (Builder $builder) => $builder->whereIn('target_group_id', $ids));
                }),
            )
            ->withGlobalScope('published', new PublishedScope)
            ->with(Series::getCardRelations())
            ->paginate(12);

        $categories = Category::query()
            ->where('model', Series::class)
            ->get();

        $targetGroups = TargetGroup::query()
            ->with('image')
            ->get();

        return Inertia::render('series/Index', [
            'series' => SeriesData::collect($series, PaginatedDataCollection::class),
            'categories' => CategoryData::collect($categories),
            'target_groups' => TargetGroupData::collect($targetGroups),
        ]);
    }

    public function show(Series $series): \Inertia\Response
    {
        $this->seriesService->ensureSeriesIsPublished($series);

        $series = $this->seriesService->loadShowRelations($series);

        $recommendedSeries = Cache::remember($this->seriesService->getRecommendedSeriesCacheKey($series), now()->addMinutes(10), function () use ($series) {
            $series = Series::query()
                ->with(Series::getCardRelations())
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
