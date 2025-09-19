<?php

namespace App\Http\Middleware;

use App\Data\Category\CategoryData;
use App\Data\TargetGroup\TargetGroupData;
use App\Data\Topic\TopicData;
use App\Data\User\AuthUserData;
use App\Models\Category;
use App\Models\EventProgram;
use App\Models\TargetGroup;
use App\Models\Topic;
use App\Services\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $cacheService = app(CacheService::class);

        $targetGroups = Cache::rememberForever($cacheService->getTargetGroupsCacheKey(), function () {
            return TargetGroupData::collect(TargetGroup::with('image')->get());
        });
        $eventProgramCategories = Cache::rememberForever($cacheService->getEventProgramCategoriesCacheKey(), function () {
            $categories = Category::where('model', EventProgram::class)->where('show_on_navbar', true)->get();

            return CategoryData::collect($categories);
        });
        $topics = Cache::remember($cacheService->getTopicsCacheKey(), 60, function () {
            $topics = Topic::whereNull('parent_id')->with('children')->get();

            return TopicData::collect($topics);
        });

        return [
            ...parent::share($request),
            'topics' => $topics,
            'target_groups' => $targetGroups,
            'active_target_group_id' => $request->session()->get('active_target_group_id', 0),
            'event_program_categories' => $eventProgramCategories,
            'auth' => [
                'user' => $request->user() ? AuthUserData::from($request->user()->toArray()) : null,
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];
    }
}
