<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RewardProgram>
 */
class RewardProgramFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->persianWords(random_int(2, 7), true),
            'short_description' => fake()->boolean() ? $this->faker->persianText(random_int(160, 210)) : null,
            'content' => $this->faker->persianParagraphs(3, true),
            'min_participants' => fake()->numberBetween(0, 50),
            'max_participants' => fake()->boolean() ? fake()->numberBetween(100, 500) : null,
            'required_score' => fake()->numberBetween(50, 500),
            'published_at' => fake()->boolean(90) ? now() : null,
        ];
    }
}
