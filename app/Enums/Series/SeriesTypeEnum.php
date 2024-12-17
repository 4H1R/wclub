<?php

namespace App\Enums\Series;

use EmreYarligan\EnumConcern\EnumConcern;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum SeriesTypeEnum: string implements HasColor, HasLabel
{
    use EnumConcern;

    case Free = 'FREE';
    case Paid = 'PAID';

    public function getLabel(): string
    {
        return match ($this) {
            self::Free => 'رایگان',
            self::Paid => 'نقدی',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Free => 'success',
            self::Paid => 'primary',
        };
    }
}
