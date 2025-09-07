<?php

namespace App\Http\Middleware;

use App\Data\TargetGroup\TargetGroupData;
use App\Data\User\AuthUserData;
use App\Models\TargetGroup;
use Illuminate\Http\Request;
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
        $activeTargetGroupId = $request->session()->get('active_target_group');
        $activeTargetGroup = $activeTargetGroupId ? TargetGroup::with('image')->find($activeTargetGroupId) : null;

        return [
            ...parent::share($request),
            'target_groups' => TargetGroupData::collect(TargetGroup::with('image')->get()),
            'active_target_group' => $activeTargetGroup ? TargetGroupData::from($activeTargetGroup) : null,
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
