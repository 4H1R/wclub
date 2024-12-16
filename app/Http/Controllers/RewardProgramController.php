<?php

namespace App\Http\Controllers;

use App\Data\Category\CategoryData;
use App\Data\RewardProgram\RewardProgramData;
use App\Data\RewardProgram\RewardProgramFullData;
use App\Models\Category;
use App\Models\RewardProgram;
use App\Models\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class RewardProgramController extends Controller
{
    public function index(): \Inertia\Response
    {
        $rewardPrograms = QueryBuilder::for(RewardProgram::class)
            ->allowedFilters([
                AllowedFilter::scope('query'),
                AllowedFilter::callback('categories_id', function (Builder $query, array $ids) {
                    $query->whereHas('categories', fn (Builder $builder) => $builder->whereIn('category_id', $ids));
                }),
            ], )
            ->allowedSorts(['created_at', 'required_score'])
            ->withGlobalScope('published', new PublishedScope)
            ->with(['image', 'categories'])
            ->fastPaginate(15);

        $categories = Category::query()
            ->where('model', RewardProgram::class)
            ->get();

        return Inertia::render('rewardPrograms/Index', [
            'reward_programs' => RewardProgramData::collect($rewardPrograms, PaginatedDataCollection::class),
            'categories' => CategoryData::collect($categories),
        ]);
    }

    public function show(RewardProgram $rewardProgram): \Inertia\Response
    {
        abort_unless($rewardProgram->published_at, 404);

        $rewardProgram->load(['categories', 'image']);

        $recommendedRewardPrograms = RewardProgram::query()
            ->with(['categories', 'image'])
            ->withGlobalScope('published', new PublishedScope)
            ->where('id', '!=', $rewardProgram->id)
            ->take(6)
            ->get();

        return Inertia::render('rewardPrograms/Show', [
            'reward_program' => RewardProgramFullData::from($rewardProgram),
            'recommended_reward_programs' => RewardProgramData::collect($recommendedRewardPrograms),
        ]);
    }
}
