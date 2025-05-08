<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyComments);
    }

    public function view(User $user, Comment $comment): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyComments);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateComments);
    }

    public function update(User $user, Comment $comment): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnyComments);
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnyComments);
    }

    public function restore(User $user, Comment $comment): bool
    {
        return false;
    }

    public function forceDelete(User $user, Comment $comment): bool
    {
        return false;
    }
}
