<?php

namespace App\Http\Controllers;

use App\Data\Category\CategoryData;
use App\Data\News\NewsData;
use App\Data\News\NewsFullData;
use App\Data\TargetGroup\TargetGroupData;
use App\Http\Middleware\FixSlugMiddleware;
use App\Models\Category;
use App\Models\News;
use App\Models\Scopes\PublishedScope;
use App\Models\TargetGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class NewsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(FixSlugMiddleware::class, only: ['show']),
        ];
    }

    public function index(): \Inertia\Response
    {
        $news = QueryBuilder::for(News::class)
            ->allowedFilters([
                AllowedFilter::scope('query'),
                AllowedFilter::callback('categories_id', function (Builder $query, array $ids) {
                    $query->whereHas('categories', fn (Builder $builder) => $builder->whereIn('category_id', $ids));
                }),
                AllowedFilter::callback('target_groups_id', function (Builder $query, array $ids) {
                    $query->whereHas('targetGroups', fn (Builder $builder) => $builder->whereIn('target_group_id', $ids));
                }),
            ], )
            ->defaultSort('-created_at')
            ->allowedSorts(['created_at'])
            ->withGlobalScope('published', new PublishedScope)
            ->with(News::getCardRelations())
            ->paginate(12);

        $categories = Category::query()
            ->where('model', News::class)
            ->get();

        $targetGroups = TargetGroup::query()
            ->with('image')
            ->get();

        return Inertia::render('news/Index', [
            'news' => NewsData::collect($news, PaginatedDataCollection::class),
            'categories' => CategoryData::collect($categories),
            'target_groups' => TargetGroupData::collect($targetGroups),
        ]);
    }

    public function show(News $news): \Inertia\Response
    {
        abort_unless($news->published_at, 404);

        $news->load(News::getCardRelations());

        $recommendedNews = News::query()
            ->with(News::getCardRelations())
            ->withGlobalScope('published', new PublishedScope)
            ->where('id', '!=', $news->id)
            ->take(6)
            ->get();

        return Inertia::render('news/Show', [
            'news' => NewsFullData::from($news),
            'recommended_news' => NewsData::collect($recommendedNews),
        ]);
    }
}
