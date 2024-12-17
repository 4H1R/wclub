<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\SeriesChapter;
use App\Models\User;

class SeriesChapterPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnySeries);
    }

    public function view(User $user, SeriesChapter $seriesChapter): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnySeries);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateSeries);
    }

    public function update(User $user, SeriesChapter $seriesChapter): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnySeries);
    }

    public function delete(User $user, SeriesChapter $seriesChapter): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnySeries);
    }

    public function restore(User $user, SeriesChapter $seriesChapter): bool
    {
        return false;
    }

    public function forceDelete(User $user, SeriesChapter $seriesChapter): bool
    {
        return false;
    }
}
