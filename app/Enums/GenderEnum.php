<?php

namespace App\Enums;

use EmreYarligan\EnumConcern\EnumConcern;
use Filament\Support\Contracts\HasLabel;

enum GenderEnum: string implements HasLabel
{
    use EnumConcern;

    case Male = 'MALE';
    case Female = 'FEMALE';

    public function getLabel(): string
    {
        return match ($this) {
            self::Male => 'مرد',
            self::Female => 'زن',
        };
    }
}
