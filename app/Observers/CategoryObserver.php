<?php

namespace App\Observers;

use App\Models\Category;
use App\Services\CacheService;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    public function __construct(private readonly CacheService $cacheService) {}

    private function clearCache(): void
    {
        Cache::forget($this->cacheService->getEventProgramCategoriesCacheKey());
    }

    public function created(Category $category): void
    {
        $this->clearCache();
    }

    public function updated(Category $category): void
    {
        $this->clearCache();
    }

    public function deleted(Category $category): void
    {
        $this->clearCache();
    }

    public function restored(Category $category): void
    {
        //
    }

    public function forceDeleted(Category $category): void
    {
        //
    }
}
