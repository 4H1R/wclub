<?php

namespace App\Data\Coupon;

use App\Enums\Coupon\CouponTypeEnum;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class CouponData extends Data
{
    public function __construct(
        public int $id,
        public int $user_id,
        public string $title,
        public string $code,
        public CouponTypeEnum $type,
        public ?int $amount,
        public ?int $percentage,
        public ?int $max_percentage_amount,
        public string $expired_at,
    ) {}
}
