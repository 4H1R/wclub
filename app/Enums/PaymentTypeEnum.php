<?php

namespace App\Enums;

use EmreYarligan\EnumConcern\EnumConcern;
use Filament\Support\Contracts\HasLabel;

enum PaymentTypeEnum: string implements HasLabel
{
    use EnumConcern;

    case Free = 'FREE';
    case Paid = 'PAID';

    public function getLabel(): string
    {
        return match ($this) {
            self::Free => 'رایگان',
            self::Paid => 'غیر رایگان',
        };
    }

    public function getColor(): string
    {
        return 'success';
    }
}
