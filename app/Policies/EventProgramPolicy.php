<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\EventProgram;
use App\Models\User;

class EventProgramPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(PermissionEnum::ViewAnyEventPrograms, PermissionEnum::ViewOwnedEventPrograms);
    }

    public function view(User $user, EventProgram $eventProgram): bool
    {
        if ($user->id === $eventProgram->user_id && $user->hasPermissionTo(PermissionEnum::ViewOwnedEventPrograms)) {
            return true;
        }

        return $user->hasPermissionTo(PermissionEnum::ViewAnyEventPrograms);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateEventPrograms);
    }

    public function update(User $user, EventProgram $eventProgram): bool
    {
        if ($user->id === $eventProgram->user_id && $user->hasPermissionTo(PermissionEnum::UpdateOwnedEventPrograms)) {
            return true;
        }

        return $user->hasPermissionTo(PermissionEnum::UpdateAnyEventPrograms);
    }

    public function delete(User $user, EventProgram $eventProgram): bool
    {
        if ($user->id === $eventProgram->user_id && $user->hasPermissionTo(PermissionEnum::DeleteOwnedEventPrograms)) {
            return true;
        }

        return $user->hasPermissionTo(PermissionEnum::DeleteAnyEventPrograms);
    }

    public function restore(User $user, EventProgram $eventProgram): bool
    {
        return false;
    }

    public function forceDelete(User $user, EventProgram $eventProgram): bool
    {
        return false;
    }
}
