<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\RewardProgram;
use App\Models\User;

class RewardProgramPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyRewardPrograms);
    }

    public function view(User $user, RewardProgram $rewardProgram): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyRoles);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateRewardPrograms);
    }

    public function update(User $user, RewardProgram $rewardProgram): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnyRewardPrograms);
    }

    public function delete(User $user, RewardProgram $rewardProgram): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnyRewardPrograms);
    }

    public function restore(User $user, RewardProgram $rewardProgram): bool
    {
        return false;
    }

    public function forceDelete(User $user, RewardProgram $rewardProgram): bool
    {
        return false;
    }
}
