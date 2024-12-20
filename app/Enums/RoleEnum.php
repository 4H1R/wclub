<?php

namespace App\Enums;

use EmreYarligan\EnumConcern\EnumConcern;
use Filament\Support\Contracts\HasLabel;

enum RoleEnum: string implements HasLabel
{
    use EnumConcern;

    case SuperAdmin = 'Super Admin';
    case Test = 'Test';

    public function getLabel(): string
    {
        return match ($this) {
            self::SuperAdmin => 'مدیر کل',
            self::Test => 'تست',
        };
    }
}
