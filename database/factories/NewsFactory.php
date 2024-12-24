<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->persianWords(random_int(2, 7), true),
            'short_description' => $this->faker->persianText(random_int(160, 210)),
            'description' => $this->faker->persianParagraphs(3, true),
            'published_at' => fake()->boolean(90) ? now() : null,
        ];
    }
}
