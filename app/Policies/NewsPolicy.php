<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\News;
use App\Models\User;

class NewsPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyNews);
    }

    public function view(User $user, News $news): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyNews);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateNews);
    }

    public function update(User $user, News $news): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnyNews);
    }

    public function delete(User $user, News $news): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnyNews);
    }

    public function restore(User $user, News $news): bool
    {
        return false;
    }

    public function forceDelete(User $user, News $news): bool
    {
        return false;
    }
}
