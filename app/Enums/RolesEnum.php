<?php

namespace App\Enums;

use EmreYarligan\EnumConcern\EnumConcern;
use Filament\Support\Contracts\HasLabel;

enum RolesEnum: string implements HasLabel
{
    use EnumConcern;

    case SuperAdmin = 'Super Admin';

    public function getLabel(): string
    {
        return match ($this) {
            self::SuperAdmin => 'مدیر کل',
        };
    }
}
