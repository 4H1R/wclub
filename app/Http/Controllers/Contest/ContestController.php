<?php

namespace App\Http\Controllers\Contest;

use App\Data\Category\CategoryData;
use App\Data\Contest\ContestData;
use App\Data\Contest\ContestFullData;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contest;
use App\Models\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ContestController extends Controller
{
    public function index(): \Inertia\Response
    {
        $news = QueryBuilder::for(Contest::class)
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
            ->paginate(15);

        $categories = Category::query()
            ->where('model', Contest::class)
            ->get();

        return Inertia::render('contests/Index', [
            'contests' => ContestData::collect($news, PaginatedDataCollection::class),
            'categories' => CategoryData::collect($categories),
        ]);
    }

    public function show(Contest $contest): \Inertia\Response
    {
        abort_unless($contest->published_at, 404);

        $contest->load(['categories', 'image']);
        $contest->has_registered = Auth::check() && $contest->registrations()->where('user_id', Auth::id())->exists();

        $recommendedContests = Contest::query()
            ->with(['categories', 'image'])
            ->withGlobalScope('published', new PublishedScope)
            ->where('id', '!=', $contest->id)
            ->take(6)
            ->get();

        return Inertia::render('contests/Show', [
            'contest' => ContestFullData::from($contest),
            'recommended_contests' => ContestData::collect($recommendedContests),
        ]);
    }
}
