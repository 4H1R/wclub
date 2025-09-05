<?php

namespace App\Observers;

use App\Enums\Logger\SiemLogIdEnum;
use App\Models\Role;
use App\Services\SiemLoggerService;

class RoleObserver
{
    public function created(Role $role): void
    {
        app(SiemLoggerService::class)->log(SiemLogIdEnum::RoleGotCreated, 'Role created');
    }

    public function updated(Role $role): void
    {
        app(SiemLoggerService::class)->log(SiemLogIdEnum::RoleGotUpdated, 'Role updated');
    }

    public function deleted(Role $role): void
    {
        app(SiemLoggerService::class)->log(SiemLogIdEnum::RoleGotDeleted, 'Role deleted');
    }

    public function restored(Role $role): void
    {
        //
    }

    public function forceDeleted(Role $role): void
    {
        //
    }
}
