<?php

namespace App\Http\Controllers;

use App\Data\RewardProgram\RewardProgramData;
use App\Models\RewardProgram;
use App\Models\Scopes\PublishedScope;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class RewardProgramController extends Controller
{
    public function index(): \Inertia\Response
    {
        $rewardPrograms = QueryBuilder::for(RewardProgram::class)
            ->allowedFilters(AllowedFilter::scope('query'))
            ->withGlobalScope('active', new PublishedScope)
            ->with(['image', 'categories'])
            ->fastPaginate(15);

        return Inertia::render('rewardPrograms/Index', [
            'reward_programs' => RewardProgramData::collect($rewardPrograms, PaginatedDataCollection::class),
        ]);
    }

    public function show(RewardProgram $rewardProgram): \Inertia\Response
    {
        return Inertia::render('rewardPrograms/Show');
    }
}
