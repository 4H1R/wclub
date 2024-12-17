<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactUs>
 */
class ContactUsFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'email' => fake()->boolean() ? fake()->safeEmail() : null,
            'phone' => '0913'.fake()->numberBetween(1111111, 9999999),
            'title' => fake()->words(rand(1, 3), true),
            'description' => fake()->paragraphs(rand(1, 3), true),
        ];
    }
}
