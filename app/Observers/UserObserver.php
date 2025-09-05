<?php

namespace App\Observers;

use App\Enums\Logger\SiemLogIdEnum;
use App\Models\User;
use App\Services\SiemLoggerService;

class UserObserver
{
    public function created(User $user): void
    {
        app(SiemLoggerService::class)->log(SiemLogIdEnum::UserGotCreated, 'User created');
    }

    public function updated(User $user): void
    {
        //
    }

    public function deleted(User $user): void
    {
        app(SiemLoggerService::class)->log(SiemLogIdEnum::UserGotDeleted, 'User deleted');
    }

    public function restored(User $user): void
    {
        //
    }

    public function forceDeleted(User $user): void
    {
        //
    }
}
