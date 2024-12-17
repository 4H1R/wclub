<?php

namespace App\Enums\Series;

use EmreYarligan\EnumConcern\EnumConcern;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum SeriesTypeEnum: string implements HasColor, HasLabel
{
    use EnumConcern;

    case Free = 'FREE';

    public function getLabel(): string
    {
        return match ($this) {
            self::Free => 'رایگان',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Free => 'success',
        };
    }
}
