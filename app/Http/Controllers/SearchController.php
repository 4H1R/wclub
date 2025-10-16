<?php

namespace App\Http\Controllers;

use App\Data\Contest\ContestData;
use App\Data\EventProgram\EventProgramData;
use App\Data\RewardProgram\RewardProgramData;
use App\Data\Series\SeriesData;
use App\Models\Contest;
use App\Models\EventProgram;
use App\Models\RewardProgram;
use App\Models\Scopes\PublishedScope;
use App\Models\Series;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    private array $models = [
        'event_programs' => ['model' => EventProgram::class, 'data' => EventProgramData::class, 'with' => ['image', 'categories', 'targetGroups']],
        'reward_programs' => ['model' => RewardProgram::class, 'data' => RewardProgramData::class, 'with' => ['image', 'categories', 'targetGroups']],
        'contests' => ['model' => Contest::class, 'data' => ContestData::class, 'with' => ['image', 'categories', 'targetGroups']],
        'series' => ['model' => Series::class, 'data' => SeriesData::class, 'with' => ['image', 'categories', 'targetGroups']],
    ];

    public function __invoke(Request $request): \Inertia\Response
    {
        $data = [];

        if ($query = $request->input('filter.query')) {
            foreach ($this->models as $name => $model) {
                $result = $model['model']::query()
                    ->withGlobalScope('published', new PublishedScope)
                    ->with($model['with'])
                    ->query($query)
                    ->take(5)
                    ->get();

                $data[$name] = $model['data']::collect($result);
            }
        }

        return Inertia::render('Search', $data);
    }
}
