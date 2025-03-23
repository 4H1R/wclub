<?php

namespace App\Enums\Transaction;

use EmreYarligan\EnumConcern\EnumConcern;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TransactionStatusEnum: string implements HasColor, HasLabel
{
    use EnumConcern;

    case Failure = 'FAILURE';
    case Successful = 'SUCCESSFUL';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Failure => 'ناموفق',
            self::Successful => 'موفق',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Failure => 'danger',
            self::Successful => 'success',
        };
    }
}
