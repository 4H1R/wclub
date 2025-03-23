<?php

namespace App\Enums\Order;

use EmreYarligan\EnumConcern\EnumConcern;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum OrderStatusEnum: string implements HasColor, HasLabel
{
    use EnumConcern;

    case WaitingForPayment = 'WAITING_FOR_PAYMENT';
    case Paid = 'PAID';
    case Canceled = 'CANCELED';
    case Ready = 'READY';
    case Sent = 'SENT';
    case Finished = 'FINISHED';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::WaitingForPayment => 'منتظر پرداخت',
            self::Paid => 'پرداخت شد',
            self::Canceled => 'لغو شد',
            self::Ready => 'آماده',
            self::Sent => 'ارسال شد',
            self::Finished => 'تمام شد',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::WaitingForPayment => 'gray',
            self::Canceled => 'error',
            self::Paid => 'success',
            self::Ready => 'success',
            self::Sent => 'success',
            self::Finished => 'success',
        };
    }
}
