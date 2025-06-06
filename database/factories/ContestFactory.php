<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contest>
 */
class ContestFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startedAt = fake()->dateTime();

        return [
            'title' => $this->faker->persianWords(random_int(2, 7), true),
            'short_description' => $this->faker->persianText(random_int(160, 210)),
            'description' => $this->faker->persianParagraphs(3, true),
            'min_participants' => fake()->numberBetween(0, 50),
            'max_participants' => fake()->boolean() ? fake()->numberBetween(100, 500) : null,
            'started_at' => $startedAt,
            'finished_at' => fake()->dateTimeBetween($startedAt, now()),
            'published_at' => fake()->boolean(90) ? now() : null,
        ];
    }
}
