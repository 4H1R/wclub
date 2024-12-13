<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->persianWords(rand(5, 10), true),
            'description' => $this->faker->persianWords(rand(10, 30), true),
            'link' => '/',
            'published_at' => fake()->boolean(90) ? now() : null,
        ];
    }
}
