<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Banner;
use App\Models\User;

class BannerPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyBanners);
    }

    public function view(User $user, Banner $banner): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyBanners);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateBanners);
    }

    public function update(User $user, Banner $banner): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnyBanners);
    }

    public function delete(User $user, Banner $banner): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnyBanners);
    }

    public function restore(User $user, Banner $banner): bool
    {
        return false;
    }

    public function forceDelete(User $user, Banner $banner): bool
    {
        return false;
    }
}
