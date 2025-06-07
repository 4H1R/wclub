<?php

namespace App\Enums\Faq;

use EmreYarligan\EnumConcern\EnumConcern;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum FaqStatusEnum: string implements HasColor, HasLabel
{
    use EnumConcern;

    case UnderReview = 'UNDER_REVIEW';
    case Approved = 'APPROVED';
    case Rejected = 'REJECTED';

    public function getLabel(): string
    {
        return match ($this) {
            self::UnderReview => 'در بررسی',
            self::Approved => 'تایید شده',
            self::Rejected => 'رد شده',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::UnderReview => 'gray',
            self::Approved => 'success',
            self::Rejected => 'danger',
        };
    }
}
