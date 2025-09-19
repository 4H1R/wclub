<?php

namespace App\Http\Controllers;

use App\Data\Banner\BannerData;
use App\Data\Contest\ContestData;
use App\Data\EventProgram\EventProgramData;
use App\Data\News\NewsData;
use App\Data\RewardProgram\RewardProgramData;
use App\Data\Series\SeriesData;
use App\Models\Banner;
use App\Models\Contest;
use App\Models\EventProgram;
use App\Models\News;
use App\Models\RewardProgram;
use App\Models\Scopes\PublishedScope;
use App\Models\Series;
use App\Services\CacheService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __construct(private readonly CacheService $cacheService) {}

    private function applyTopicFilter(Builder $query, int $topicId): Builder
    {
        return $query->whereHas('topics', fn (Builder $builder) => $builder->where('topic_id', $topicId));
    }

    public function __invoke(Request $request): \Inertia\Response|RedirectResponse
    {
        // Isfahan SSO redirect
        if ($code = $request->input('Code')) {
            return to_route('auth.my-isfahan.callback', ['code' => $code]);
        }

        $topicId = $request->input('topic_id');
        $cacheKey = $this->cacheService->getIndexCacheKey($request->session()->get('active_target_group_id', 0), $topicId);

        $data = Cache::remember($cacheKey, 60, function () use ($topicId) {
            $banners = Banner::query()
                ->with('image')
                ->withGlobalScope('published', new PublishedScope)
                ->get();

            $eventPrograms = EventProgram::query()
                ->with(EventProgram::getCardRelations())
                ->latest('id')
                ->take(8)
                ->when($topicId, fn (Builder $query) => $this->applyTopicFilter($query, $topicId))
                ->withGlobalScope('published', new PublishedScope)
                ->get();

            $rewardPrograms = RewardProgram::query()
                ->with(RewardProgram::getCardRelations())
                ->inRandomOrder()
                ->take(8)
                ->withGlobalScope('published', new PublishedScope)
                ->get();

            $contests = Contest::query()
                ->with(Contest::getCardRelations())
                ->latest('id')
                ->take(8)
                ->when($topicId, fn (Builder $query) => $this->applyTopicFilter($query, $topicId))
                ->withGlobalScope('published', new PublishedScope)
                ->get();

            $series = Series::query()
                ->with(Series::getCardRelations())
                ->inRandomOrder()
                ->take(8)
                ->when($topicId, fn (Builder $query) => $this->applyTopicFilter($query, $topicId))
                ->withGlobalScope('published', new PublishedScope)
                ->get();

            $news = News::query()
                ->with(News::getCardRelations())
                ->latest('id')
                ->take(8)
                ->when($topicId, fn (Builder $query) => $this->applyTopicFilter($query, $topicId))
                ->withGlobalScope('published', new PublishedScope)
                ->get();

            return [
                'banners' => BannerData::collect($banners),
                'event_programs' => EventProgramData::collect($eventPrograms),
                'reward_programs' => RewardProgramData::collect($rewardPrograms),
                'contests' => ContestData::collect($contests),
                'series' => SeriesData::collect($series),
                'news' => NewsData::collect($news),
            ];
        });

        return Inertia::render('Index', $data);
    }
}
