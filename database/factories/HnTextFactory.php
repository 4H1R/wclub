<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HnText>
 */
class HnTextFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => $this->faker->persianWords(random_int(2, 7), true),
            'author' => $this->faker->name,
            'published_at' => fake()->boolean(90) ? now() : null,
        ];
    }
}
