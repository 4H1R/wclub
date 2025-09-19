<?php

namespace App\Observers;

use App\Models\Topic;
use App\Services\CacheService;
use Illuminate\Support\Facades\Cache;

class TopicObserver
{
    public function __construct(private readonly CacheService $cacheService) {}

    private function clearCache(): void
    {
        Cache::forget($this->cacheService->getTopicsCacheKey());
    }

    public function created(Topic $topic): void
    {
        $this->clearCache();
    }

    public function updated(Topic $topic): void
    {
        $this->clearCache();
    }

    public function deleted(Topic $topic): void
    {
        $this->clearCache();
    }

    public function restored(Topic $topic): void
    {
        //
    }

    public function forceDeleted(Topic $topic): void
    {
        //
    }
}
