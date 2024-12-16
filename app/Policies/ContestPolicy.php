<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Contest;
use App\Models\User;

class ContestPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyContests);
    }

    public function view(User $user, Contest $contest): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyContests);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateContests);
    }

    public function update(User $user, Contest $contest): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnyContests);
    }

    public function delete(User $user, Contest $contest): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnyContests);
    }

    public function restore(User $user, Contest $contest): bool
    {
        return false;
    }

    public function forceDelete(User $user, Contest $contest): bool
    {
        return false;
    }
}
