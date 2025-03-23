<?php

namespace App\Enums\Order;

use EmreYarligan\EnumConcern\EnumConcern;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum OrderPaymentStatusEnum: string implements HasColor, HasLabel
{
    use EnumConcern;

    case WaitingForPayment = 'WAITING_FOR_PAYMENT';
    case Failure = 'FAILURE';
    case Successful = 'SUCCESSFUL';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::WaitingForPayment => 'منتظر پرداخت',
            self::Failure => 'ناموفق',
            self::Successful => 'موفق',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::WaitingForPayment => 'gray',
            self::Failure => 'danger',
            self::Successful => 'success',
        };
    }
}
