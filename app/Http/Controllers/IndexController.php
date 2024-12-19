<?php

namespace App\Http\Controllers;

use App\Data\Banner\BannerData;
use App\Data\Contest\ContestData;
use App\Data\EventProgram\EventProgramData;
use App\Data\RewardProgram\RewardProgramData;
use App\Data\Series\SeriesData;
use App\Data\TargetGroup\TargetGroupData;
use App\Models\Banner;
use App\Models\Contest;
use App\Models\EventProgram;
use App\Models\RewardProgram;
use App\Models\Scopes\PublishedScope;
use App\Models\Series;
use App\Models\TargetGroup;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke(Request $request): \Inertia\Response
    {
        $targetGroups = TargetGroup::query()
            ->with('image')
            ->get();

        $banners = Banner::query()
            ->with('image')
            ->withGlobalScope('published', new PublishedScope)
            ->get();

        $eventPrograms = EventProgram::query()
            ->with(['categories', 'image'])
            ->latest('id')
            ->take(8)
            ->get();

        $rewardPrograms = RewardProgram::query()
            ->with(['categories', 'image'])
            ->inRandomOrder()
            ->take(8)
            ->get();

        $contests = Contest::query()
            ->with(['categories', 'image'])
            ->latest('id')
            ->take(8)
            ->get();

        $series = Series::query()
            ->with(['categories', 'image'])
            ->inRandomOrder()
            ->take(8)
            ->get();

        return Inertia::render('Index', [
            'target_groups' => TargetGroupData::collect($targetGroups),
            'banners' => BannerData::collect($banners),
            'event_programs' => EventProgramData::collect($eventPrograms),
            'reward_programs' => RewardProgramData::collect($rewardPrograms),
            'contests' => ContestData::collect($contests),
            'series' => SeriesData::collect($series),
        ]);
    }
}
