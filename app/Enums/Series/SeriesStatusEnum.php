<?php

namespace App\Enums\Series;

use EmreYarligan\EnumConcern\EnumConcern;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum SeriesStatusEnum: string implements HasColor, HasLabel
{
    use EnumConcern;

    case InProgress = 'IN_PROGRESS';
    case Finished = 'FINISHED';

    public function getLabel(): string
    {
        return match ($this) {
            self::InProgress => 'در حال برگزاری',
            self::Finished => 'تکمیل ضبط',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::InProgress => 'gray',
            self::Finished => 'primary',
        };
    }
}
