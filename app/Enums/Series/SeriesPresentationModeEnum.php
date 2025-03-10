<?php

namespace App\Enums\Series;

use EmreYarligan\EnumConcern\EnumConcern;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum SeriesPresentationModeEnum: string implements HasColor, HasLabel
{
    use EnumConcern;

    case InPerson = 'IN_PERSON';
    case Online = 'ONLINE';
    case Platform = 'PLATFORM';

    public function getLabel(): string
    {
        return match ($this) {
            self::InPerson => 'حضوری',
            self::Online => 'آنلاین',
            self::Platform => 'پلتفرم',
        };
    }

    public function getColor(): string
    {
        return 'primary';
    }
}
