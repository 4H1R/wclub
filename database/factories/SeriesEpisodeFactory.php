<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeriesEpisode>
 */
class SeriesEpisodeFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->persianWords(rand(4, 8), true),
            'description' => fake()->boolean() ? $this->faker->persianParagraphs(rand(1, 5), true) : null,
            'video_duration_seconds' => rand(60, 21600),
            'watch_score' => rand(5, 100),
            'published_at' => fake()->boolean(90) ? now() : null,
        ];
    }
}
