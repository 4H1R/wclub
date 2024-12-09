<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\User;

class UserPolicy
{
    public function isAffectingSuperAdmin(User $user, User $model): bool
    {
        return ! $user->isSuperAdmin() && $model->isSuperAdmin();
    }

    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ViewUser, PermissionEnum::ViewAnyUsers);
    }

    public function view(User $user, User $model): bool
    {
        if ($user->id === $model->id && $user->hasPermissionTo(PermissionEnum::ViewUser)) {
            return true;
        }

        return $user->hasPermissionTo(PermissionEnum::ViewAnyUsers);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateUsers);
    }

    public function update(User $user, User $model): bool
    {
        if ($this->isAffectingSuperAdmin($user, $model)) {
            return false;
        }

        if ($user->id === $model->id && $user->hasPermissionTo(PermissionEnum::UpdateUser)) {
            return true;
        }

        return $user->hasPermissionTo(PermissionEnum::UpdateAnyUsers);
    }

    public function delete(User $user, User $model): bool
    {
        if ($this->isAffectingSuperAdmin($user, $model)) {
            return false;
        }

        return $user->hasPermissionTo(PermissionEnum::DeleteAnyUsers);
    }

    public function restore(User $user, User $model): bool
    {
        return false;
    }

    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
