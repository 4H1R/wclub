<?php

namespace Database\Factories;

use App\Enums\Faq\FaqStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => FaqStatusEnum::randomValue(),
            'question' => $this->faker->persianText(rand(150, 250), true),
            'answer' => fake()->boolean() ? $this->faker->persianParagraphs(rand(1, 5), true) : null,
            'user_id' => User::factory(),
        ];
    }
}
