<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;

class RolePolicy
{
    public function isAffectingSuperAdmin(Role $role): bool
    {
        return $role->name === RoleEnum::SuperAdmin->value;
    }

    public function canViewSuperAdmin(User $user, Role $role): bool
    {
        return $role->name === RoleEnum::SuperAdmin->value && ! $user->hasRole(RoleEnum::SuperAdmin);
    }

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyRoles);
    }

    public function view(User $user, Role $role): bool
    {
        if ($this->canViewSuperAdmin($user, $role)) {
            return false;
        }

        return $user->hasPermissionTo(PermissionEnum::ViewAnyRoles);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateRoles);
    }

    public function update(User $user, Role $role): bool
    {
        if ($this->isAffectingSuperAdmin($role)) {
            return false;
        }

        return $user->hasPermissionTo(PermissionEnum::UpdateAnyRoles);
    }

    public function delete(User $user, Role $role): bool
    {
        if ($this->isAffectingSuperAdmin($role)) {
            return false;
        }

        return $user->hasPermissionTo(PermissionEnum::DeleteAnyRoles);
    }

    public function restore(User $user, Role $role): bool
    {
        return false;
    }

    public function forceDelete(User $user, Role $role): bool
    {
        return false;
    }
}
