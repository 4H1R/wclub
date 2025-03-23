<?php

namespace App\Enums\Transaction;

use EmreYarligan\EnumConcern\EnumConcern;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TransactionGatewayNameEnum: string implements HasColor, HasLabel
{
    use EnumConcern;

    case Mellat = 'MELLAT';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Mellat => 'بانک ملت',
        };
    }

    public function getColor(): string
    {
        return 'primary';
    }
}
