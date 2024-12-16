<?php

namespace App\Http\Controllers;

use App\Data\Category\CategoryData;
use App\Data\Contest\ContestData;
use App\Models\Category;
use App\Models\Contest;
use App\Models\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ContestController extends Controller
{
    public function index(): \Inertia\Response
    {
        $eventPrograms = QueryBuilder::for(Contest::class)
            ->allowedFilters([
                AllowedFilter::scope('query'),
                AllowedFilter::callback('categories_id', function (Builder $query, array $ids) {
                    $query->whereHas('categories', fn (Builder $builder) => $builder->whereIn('category_id', $ids));
                }),
            ], )
            ->defaultSort('-created_at')
            ->allowedSorts(['created_at', 'min_participants', 'max_participants'])
            ->withGlobalScope('published', new PublishedScope)
            ->with(['image', 'categories'])
            ->fastPaginate(15);

        $categories = Category::query()
            ->where('model', Contest::class)
            ->get();

        return Inertia::render('contests/Index', [
            'contests' => ContestData::collect($eventPrograms, PaginatedDataCollection::class),
            'categories' => CategoryData::collect($categories),
        ]);
    }
}
