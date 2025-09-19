<?php

namespace App\Policies;

use App\Models\Topic;
use App\Models\User;

class TopicPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, Topic $topic): bool
    {
        return $user->isSuperAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    public function update(User $user, Topic $topic): bool
    {
        return $user->isSuperAdmin();
    }

    public function delete(User $user, Topic $topic): bool
    {
        return $user->isSuperAdmin();
    }

    public function restore(User $user, Topic $topic): bool
    {
        return false;
    }

    public function forceDelete(User $user, Topic $topic): bool
    {
        return false;
    }
}
