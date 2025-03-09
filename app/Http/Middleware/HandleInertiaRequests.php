<?php

namespace App\Http\Middleware;

use App\Data\User\AuthUserData;
use App\Enums\PermissionEnum;
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
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user() ? AuthUserData::from([
                    ...$request->user()->toArray(),
                    'can_access_admin_panel' => $request->user()->hasPermissionTo(PermissionEnum::ViewAdminPanel),
                ]) : null,
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];
    }
}
