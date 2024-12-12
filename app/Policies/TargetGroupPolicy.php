<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\TargetGroup;
use App\Models\User;

class TargetGroupPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyTargetGroups);
    }

    public function view(User $user, TargetGroup $targetGroup): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyTargetGroups);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateTargetGroups);
    }

    public function update(User $user, TargetGroup $targetGroup): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnyTargetGroups);
    }

    public function delete(User $user, TargetGroup $targetGroup): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnyTargetGroups);
    }

    public function restore(User $user, TargetGroup $targetGroup): bool
    {
        return false;
    }

    public function forceDelete(User $user, TargetGroup $targetGroup): bool
    {
        return false;
    }
}
