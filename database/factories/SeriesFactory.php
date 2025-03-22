<?php

namespace Database\Factories;

use App\Enums\PaymentTypeEnum;
use App\Enums\Series\SeriesPresentationModeEnum;
use App\Enums\Series\SeriesStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Series>
 */
class SeriesFactory extends Factory
{
    public function createFaqs(): array
    {
        $faqs = [];
        for ($i = 0; $i < rand(3, 10); $i++) {
            $faqs[] = [
                'title' => $this->faker->persianWords(rand(4, 8), true),
                'description' => $this->faker->persianParagraphs(1, true),
            ];
        }

        return $faqs;
    }

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paymentType = PaymentTypeEnum::randomValue();
        $price = fake()->numberBetween(500_000, 5_000_000);

        $isFree = PaymentTypeEnum::from($paymentType) === PaymentTypeEnum::Free;
        $previousPrice = fake()->boolean() ? fake()->numberBetween($price, $price + fake()->numberBetween(10_000, 500_000)) : null;

        return [
            'title' => $this->faker->persianWords(rand(4, 8), true),
            'status' => SeriesStatusEnum::randomValue(),
            'presentation_mode' => SeriesPresentationModeEnum::randomValue(),
            'payment_type' => $paymentType,
            'price' => $isFree ? null : $price,
            'previous_price' => $isFree ? null : $previousPrice,
            'short_description' => $this->faker->persianText(rand(150, 250), true),
            'description' => $this->faker->persianParagraphs(rand(1, 5), true),
            'faqs' => fake()->boolean() ? $this->createFaqs() : null,
            'episodes_duration_seconds' => rand(3_600, 190_000),
            'published_at' => fake()->boolean(90) ? now() : null,
        ];
    }
}
