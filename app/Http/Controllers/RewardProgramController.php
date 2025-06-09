<?php

namespace App\Http\Controllers;

use App\Data\Category\CategoryData;
use App\Data\RewardProgram\RewardProgramData;
use App\Data\RewardProgram\RewardProgramFullData;
use App\Data\TargetGroup\TargetGroupData;
use App\Http\Middleware\FixSlugMiddleware;
use App\Models\Category;
use App\Models\RewardProgram;
use App\Models\Scopes\PublishedScope;
use App\Models\TargetGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class RewardProgramController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(FixSlugMiddleware::class, only: ['show']),
        ];
    }

    public function index(): \Inertia\Response
    {
        $rewardPrograms = QueryBuilder::for(RewardProgram::class)
            ->allowedFilters([
                AllowedFilter::scope('query'),
                AllowedFilter::callback('categories_id', function (Builder $query, array $ids) {
                    $query->whereHas('categories', fn (Builder $builder) => $builder->whereIn('category_id', $ids));
                }),
                AllowedFilter::callback('target_groups_id', function (Builder $query, array $ids) {
                    $query->whereHas('targetGroups', fn (Builder $builder) => $builder->whereIn('target_group_id', $ids));
                }),
            ], )
            ->allowedSorts(['created_at', 'required_score'])
            ->withGlobalScope('published', new PublishedScope)
            ->with(RewardProgram::getCardRelations())
            ->paginate(12);

        $categories = Category::query()
            ->where('model', RewardProgram::class)
            ->get();

        $targetGroups = TargetGroup::query()
            ->with('image')
            ->get();

        return Inertia::render('rewardPrograms/Index', [
            'reward_programs' => RewardProgramData::collect($rewardPrograms, PaginatedDataCollection::class),
            'categories' => CategoryData::collect($categories),
            'target_groups' => TargetGroupData::collect($targetGroups),
        ]);
    }

    public function show(RewardProgram $rewardProgram): \Inertia\Response
    {
        abort_unless($rewardProgram->published_at, 404);

        $rewardProgram->load(RewardProgram::getCardRelations());

        $recommendedRewardPrograms = RewardProgram::query()
            ->with(RewardProgram::getCardRelations())
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
