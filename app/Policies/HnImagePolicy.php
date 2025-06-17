<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\HnImage;
use App\Models\User;

class HnImagePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyHnImages);
    }

    public function view(User $user, HnImage $hnImage): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyHnImages);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateHnImages);
    }

    public function update(User $user, HnImage $hnImage): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnyHnImages);
    }

    public function delete(User $user, HnImage $hnImage): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnyHnImages);
    }

    public function restore(User $user, HnImage $hnImage): bool
    {
        return false;
    }

    public function forceDelete(User $user, HnImage $hnImage): bool
    {
        return false;
    }
}
