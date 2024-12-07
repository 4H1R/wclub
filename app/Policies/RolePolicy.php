<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use App\Models\Role;
use App\Models\User;

class RolePolicy
{
    public function isAffectingSuperAdmin(Role $role): bool
    {
        return $role->name === RolesEnum::SuperAdmin->value;
    }

    public function canViewSuperAdmin(User $user, Role $role): bool
    {
        return $role->name === RolesEnum::SuperAdmin->value && ! $user->hasRole(RolesEnum::SuperAdmin);
    }

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionsEnum::ViewAnyRoles);
    }

    public function view(User $user, Role $role): bool
    {
        if ($this->canViewSuperAdmin($user, $role)) {
            return false;
        }

        return $user->hasPermissionTo(PermissionsEnum::ViewAnyRoles);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionsEnum::CreateRoles);
    }

    public function update(User $user, Role $role): bool
    {
        if ($this->isAffectingSuperAdmin($role)) {
            return false;
        }

        return $user->hasPermissionTo(PermissionsEnum::UpdateAnyRoles);
    }

    public function delete(User $user, Role $role): bool
    {
        if ($this->isAffectingSuperAdmin($role)) {
            return false;
        }

        return $user->hasPermissionTo(PermissionsEnum::DeleteAnyRoles);
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
