<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyOrders);
    }

    public function view(User $user, Order $order): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyOrders);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateOrders);
    }

    public function update(User $user, Order $order): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnyOrders);
    }

    public function delete(User $user, Order $order): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnyOrders);
    }

    public function restore(User $user, Order $order): bool
    {
        return false;
    }

    public function forceDelete(User $user, Order $order): bool
    {
        return false;
    }
}
