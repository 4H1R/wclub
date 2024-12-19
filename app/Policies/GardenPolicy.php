<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Garden;
use App\Models\User;

class GardenPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyGardens);
    }

    public function view(User $user, Garden $garden): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyGardens);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateGardens);
    }

    public function update(User $user, Garden $garden): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnyGardens);
    }

    public function delete(User $user, Garden $garden): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnyGardens);
    }

    public function restore(User $user, Garden $garden): bool
    {
        return false;
    }

    public function forceDelete(User $user, Garden $garden): bool
    {
        return false;
    }
}
