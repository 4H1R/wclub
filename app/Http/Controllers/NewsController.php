<?php

namespace App\Http\Controllers;

use App\Data\Category\CategoryData;
use App\Data\News\NewsData;
use App\Data\News\NewsFullData;
use App\Models\Category;
use App\Models\News;
use App\Models\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class NewsController extends Controller
{
    public function index(): \Inertia\Response
    {
        $news = QueryBuilder::for(News::class)
            ->allowedFilters([
                AllowedFilter::scope('query'),
                AllowedFilter::callback('categories_id', function (Builder $query, array $ids) {
                    $query->whereHas('categories', fn (Builder $builder) => $builder->whereIn('category_id', $ids));
                }),
            ], )
            ->defaultSort('-created_at')
            ->allowedSorts(['created_at'])
            ->withGlobalScope('published', new PublishedScope)
            ->with(['image', 'categories'])
            ->paginate(12);

        $categories = Category::query()
            ->where('model', News::class)
            ->get();

        return Inertia::render('news/Index', [
            'news' => NewsData::collect($news, PaginatedDataCollection::class),
            'categories' => CategoryData::collect($categories),
        ]);
    }

    public function show(News $news): \Inertia\Response
    {
        abort_unless($news->published_at, 404);

        $news->load(['categories', 'image']);

        $recommendedNews = News::query()
            ->with(['categories', 'image'])
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
