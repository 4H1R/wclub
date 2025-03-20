<?php

namespace App\Enums\Coupon;

use EmreYarligan\EnumConcern\EnumConcern;
use Filament\Support\Contracts\HasLabel;

enum CouponTypeEnum: string implements HasLabel
{
    use EnumConcern;

    case Amount = 'AMOUNT';
    case Percentage = 'PERCENTAGE';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Amount => 'مقدار',
            self::Percentage => 'درصد',
        };
    }
}
