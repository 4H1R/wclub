<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\OrderItem;
use App\Models\User;

class OrderItemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyOrders);
    }

    public function view(User $user, OrderItem $orderItem): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyOrders);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateOrders);
    }

    public function update(User $user, OrderItem $orderItem): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnyOrders);
    }

    public function delete(User $user, OrderItem $orderItem): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnyOrders);
    }

    public function restore(User $user, OrderItem $orderItem): bool
    {
        return false;
    }

    public function forceDelete(User $user, OrderItem $orderItem): bool
    {
        return false;
    }
}
