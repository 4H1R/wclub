<?php

namespace Database\Factories;

use App\Enums\Series\SeriesStatusEnum;
use App\Enums\Series\SeriesTypeEnum;
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
        $type = SeriesTypeEnum::randomValue();

        return [
            'title' => $this->faker->persianWords(rand(4, 8), true),
            'status' => SeriesStatusEnum::randomValue(),
            'type' => $type,
            'short_description' => $this->faker->persianText(rand(150, 250), true),
            'description' => $this->faker->persianParagraphs(rand(1, 5), true),
            'faqs' => fake()->boolean() ? $this->createFaqs() : null,
            'episodes_duration_seconds' => rand(3_600, 190_000),
            'published_at' => fake()->boolean(90) ? now() : null,
        ];
    }
}
