<?php

namespace App\Enums\EventProgram;

enum EventProgramStatusEnum: string implements \Filament\Support\Contracts\HasLabel
{
    use \EmreYarligan\EnumConcern\EnumConcern;

    case InProgress = 'IN_PROGRESS';
    case Indicator = 'INDICATOR';
    case Archive = 'ARCHIVE';

    public function getLabel(): string
    {
        return match ($this) {
            self::InProgress => 'در حال برگزاری',
            self::Indicator => 'شاخص',
            self::Archive => 'آرشیو',
        };
    }
}
