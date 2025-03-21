<?php

namespace Database\Factories;

use App\Enums\Coupon\CouponTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isAmount = CouponTypeEnum::randomValue() === CouponTypeEnum::Amount;

        return [
            'title' => $this->faker->persianWords(rand(3, 5), true),
            'code' => fake()->unique()->word(),
            'type' => $isAmount ? CouponTypeEnum::Amount : CouponTypeEnum::Percentage,
            'amount' => $isAmount ? fake()->numberBetween(1_000, 10_000) : null,
            'percentage' => ! $isAmount ? fake()->numberBetween(5, 60) : null,
            'max_percentage_amount' => ! $isAmount ? fake()->numberBetween(10_000, 30_000) : null,
            'expired_at' => fake()->dateTimeBetween('-1 year', '+1 year'),
        ];
    }
}
