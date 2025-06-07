<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Faq;
use App\Models\User;

class FaqPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyFaqs);
    }

    public function view(User $user, Faq $faq): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyFaqs);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateFaqs);
    }

    public function update(User $user, Faq $faq): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnyFaqs);
    }

    public function delete(User $user, Faq $faq): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnyFaqs);
    }

    public function restore(User $user, Faq $faq): bool
    {
        return false;
    }

    public function forceDelete(User $user, Faq $faq): bool
    {
        return false;
    }
}
