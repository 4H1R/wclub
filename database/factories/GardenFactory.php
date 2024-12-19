<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Garden>
 */
class GardenFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->persianWords(random_int(2, 7), true),
            'description' => $this->faker->persianParagraphs(3, true),
            'address' => fake()->address(),
            'longitude' => fake()->longitude(),
            'latitude' => fake()->latitude(),
            'max_participants' => fake()->numberBetween(100, 500),
            'published_at' => fake()->boolean(90) ? now() : null,
        ];
    }
}
