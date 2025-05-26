<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\ContactUs;
use App\Models\User;

class ContactUsPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyContactUs);
    }

    public function view(User $user, ContactUs $contactUs): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyContactUs);
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, ContactUs $contactUs): bool
    {
        return false;
    }

    public function delete(User $user, ContactUs $contactUs): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnyContactUs);
    }

    public function restore(User $user, ContactUs $contactUs): bool
    {
        return false;
    }

    public function forceDelete(User $user, ContactUs $contactUs): bool
    {
        return false;
    }
}
