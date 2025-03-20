<?php

namespace App\Models;

use App\Enums\Coupon\CouponTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperCoupon
 */
class Coupon extends Model
{
    /** @use HasFactory<\Database\Factories\CouponFactory> */
    use HasFactory;

    protected $casts = [
        'type' => CouponTypeEnum::class,
        'expired_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isExpired(): bool
    {
        return now()->greaterThanOrEqualTo($this->expired_at);
    }

    public function calculateDiscount(int $price): float
    {
        if ($this->isExpired()) {
            return 0;
        }

        if ($this->type === CouponTypeEnum::Amount) {
            return $this->amount;
        }

        $maxPercentageAmount = $this->max_percentage_amount ?? $price;
        $customerPrice = min($maxPercentageAmount, $price);

        return round(($this->percentage / 100) * $customerPrice);
    }
}
