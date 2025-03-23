<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Transaction;
use App\Models\User;

class TransactionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyTransactions);
    }

    public function view(User $user, Transaction $transaction): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyTransactions);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateTransactions);
    }

    public function update(User $user, Transaction $transaction): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnyTransactions);
    }

    public function delete(User $user, Transaction $transaction): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnyTransactions);
    }

    public function restore(User $user, Transaction $transaction): bool
    {
        return false;
    }

    public function forceDelete(User $user, Transaction $transaction): bool
    {
        return false;
    }
}
