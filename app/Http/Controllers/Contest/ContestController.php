<?php

namespace App\Http\Controllers\Contest;

use App\Data\Category\CategoryData;
use App\Data\Contest\ContestData;
use App\Data\Contest\ContestFullData;
use App\Data\TargetGroup\TargetGroupData;
use App\Http\Controllers\Controller;
use App\Http\Middleware\FixSlugMiddleware;
use App\Models\Category;
use App\Models\Contest;
use App\Models\Scopes\PublishedScope;
use App\Models\TargetGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ContestController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(FixSlugMiddleware::class, only: ['show']),
        ];
    }

    public function index(): \Inertia\Response
    {
        $news = QueryBuilder::for(Contest::class)
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
            ->allowedSorts(['created_at', 'min_participants', 'max_participants'])
            ->withGlobalScope('published', new PublishedScope)
            ->with(Contest::getCardRelations())
            ->paginate(12);

        $categories = Category::query()
            ->where('model', Contest::class)
            ->get();

        $targetGroups = TargetGroup::query()
            ->with('image')
            ->get();

        return Inertia::render('contests/Index', [
            'contests' => ContestData::collect($news, PaginatedDataCollection::class),
            'categories' => CategoryData::collect($categories),
            'target_groups' => TargetGroupData::collect($targetGroups),
        ]);
    }

    public function show(Contest $contest): \Inertia\Response
    {
        abort_unless($contest->published_at, 404);

        $contest->load(Contest::getCardRelations());
        $contest->has_registered = Auth::check() && $contest->registrations()->where('user_id', Auth::id())->exists();

        $recommendedContests = Contest::query()
            ->with(Contest::getCardRelations())
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
