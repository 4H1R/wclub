<?php

namespace App\Models;

use App\Enums\RoleEnum;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @mixin IdeHelperRole
 */
class Role extends SpatieRole
{
    public static function superAdmin(): Role
    {
        return once(fn () => self::where('name', RoleEnum::SuperAdmin)->firstOrFail());
    }
}
