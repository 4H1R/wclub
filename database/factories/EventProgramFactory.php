<?php

namespace Database\Factories;

use App\Enums\PaymentTypeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventProgram>
 */
class EventProgramFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startedAt = fake()->dateTime();
        $paymentType = PaymentTypeEnum::randomValue();
        $price = fake()->numberBetween(500_000, 5_000_000);

        $isFree = PaymentTypeEnum::from($paymentType) === PaymentTypeEnum::Free;
        $previousPrice = fake()->boolean() ? fake()->numberBetween($price, $price + fake()->numberBetween(10_000, 500_000)) : null;

        return [
            'payment_type' => $paymentType,
            'price' => $isFree ? null : $price,
            'previous_price' => $isFree ? null : $previousPrice,
            'title' => $this->faker->persianWords(random_int(2, 7), true),
            'short_description' => $this->faker->persianText(random_int(160, 210)),
            'description' => $this->faker->persianParagraphs(3, true),
            'min_participants' => fake()->numberBetween(0, 50),
            'max_participants' => fake()->boolean() ? fake()->numberBetween(100, 500) : null,
            'started_at' => $startedAt,
            'finished_at' => fake()->dateTimeBetween($startedAt, now()),
            'published_at' => fake()->boolean(90) ? now() : null,
            'user_id' => User::factory(),
        ];
    }
}
