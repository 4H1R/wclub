<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\User;

class UserPolicy
{
    public function isAffectingSuperAdmin(User $user, User $model): bool
    {
        return ! $user->isSuperAdmin() && $model->isSuperAdmin();
    }

    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionsEnum::ViewUser, PermissionsEnum::ViewAnyUsers);
    }

    public function view(User $user, User $model): bool
    {
        if ($user->id === $model->id && $user->hasPermissionTo(PermissionsEnum::ViewUser)) {
            return true;
        }

        return $user->hasPermissionTo(PermissionsEnum::ViewAnyUsers);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionsEnum::CreateUsers);
    }

    public function update(User $user, User $model): bool
    {
        if ($this->isAffectingSuperAdmin($user, $model)) {
            return false;
        }

        if ($user->id === $model->id && $user->hasPermissionTo(PermissionsEnum::UpdateUser)) {
            return true;
        }

        return $user->hasPermissionTo(PermissionsEnum::UpdateAnyUsers);
    }

    public function delete(User $user, User $model): bool
    {
        if ($this->isAffectingSuperAdmin($user, $model)) {
            return false;
        }

        return $user->hasPermissionTo(PermissionsEnum::DeleteAnyUsers);
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
