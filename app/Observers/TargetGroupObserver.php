<?php

namespace App\Observers;

use App\Models\TargetGroup;
use App\Services\CacheService;
use Illuminate\Support\Facades\Cache;

class TargetGroupObserver
{
    public function __construct(private readonly CacheService $cacheService) {}

    private function clearCache(): void
    {
        Cache::forget($this->cacheService->getTargetGroupsCacheKey());
    }

    public function created(TargetGroup $targetGroup): void
    {
        $this->clearCache();
    }

    public function updated(TargetGroup $targetGroup): void
    {
        $this->clearCache();
    }

    public function deleted(TargetGroup $targetGroup): void
    {
        $this->clearCache();
    }

    public function restored(TargetGroup $targetGroup): void
    {
        //
    }

    public function forceDeleted(TargetGroup $targetGroup): void
    {
        //
    }
}
