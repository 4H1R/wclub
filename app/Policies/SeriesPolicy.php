<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Series;
use App\Models\User;

class SeriesPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnySeries);
    }

    public function view(User $user, Series $series): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnySeries);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateSeries);
    }

    public function update(User $user, Series $series): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnySeries);
    }

    public function delete(User $user, Series $series): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnySeries);
    }

    public function restore(User $user, Series $series): bool
    {
        return false;
    }

    public function forceDelete(User $user, Series $series): bool
    {
        return false;
    }
}
