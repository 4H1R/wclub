<?php

namespace Database\Factories;

use App\Models\Series;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeriesChapter>
 */
class SeriesChapterFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->persianWords(rand(2, 3), true),
            'published_at' => fake()->boolean(90) ? now() : null,
            'series_id' => Series::factory(),
        ];
    }
}
