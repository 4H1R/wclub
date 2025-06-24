<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\HnText;
use App\Models\User;

class HnTextPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyHnTexts);
    }

    public function view(User $user, HnText $hnText): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyHnTexts);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateHnTexts);
    }

    public function update(User $user, HnText $hnText): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnyHnTexts);
    }

    public function delete(User $user, HnText $hnText): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnyHnTexts);
    }

    public function restore(User $user, HnText $hnText): bool
    {
        return false;
    }

    public function forceDelete(User $user, HnText $hnText): bool
    {
        return false;
    }
}
