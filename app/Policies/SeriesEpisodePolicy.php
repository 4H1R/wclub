<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\SeriesEpisode;
use App\Models\User;

class SeriesEpisodePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnySeries);
    }

    public function view(User $user, SeriesEpisode $seriesEpisode): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnySeries);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateSeries);
    }

    public function update(User $user, SeriesEpisode $seriesEpisode): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnySeries);
    }

    public function delete(User $user, SeriesEpisode $seriesEpisode): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnySeries);
    }

    public function restore(User $user, SeriesEpisode $seriesEpisode): bool
    {
        return false;
    }

    public function forceDelete(User $user, SeriesEpisode $seriesEpisode): bool
    {
        return false;
    }
}
