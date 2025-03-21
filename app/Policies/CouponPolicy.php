<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Coupon;
use App\Models\User;

class CouponPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyCoupons);
    }

    public function view(User $user, Coupon $coupon): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyCoupons);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateCoupons);
    }

    public function update(User $user, Coupon $coupon): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnyCoupons);
    }

    public function delete(User $user, Coupon $coupon): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnyCoupons);
    }

    public function restore(User $user, Coupon $coupon): bool
    {
        return false;
    }

    public function forceDelete(User $user, Coupon $coupon): bool
    {
        return false;
    }
}
