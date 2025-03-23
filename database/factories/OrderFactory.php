<?php

namespace Database\Factories;

use App\Enums\Order\OrderPaymentStatusEnum;
use App\Enums\Order\OrderStatusEnum;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hasCoupon = false;
        $couponAmount = $hasCoupon ? random_int(50_000, 80_000) : 0;
        $totalAmount = random_int(100_000, 1_000_000);

        return [
            'status' => OrderStatusEnum::randomValue(),
            'payment_status' => OrderPaymentStatusEnum::randomValue(),
            'total_amount' => $totalAmount,
            'coupon_amount' => $couponAmount,
            'paying_amount' => $totalAmount - $couponAmount,
            'description' => fake()->boolean() ? $this->faker->persianText(rand(60, 220), true) : null,
            'user_id' => fake()->boolean() ? User::factory() : null,
            'coupon_id' => $hasCoupon ? Coupon::factory() : null,
        ];
    }
}
