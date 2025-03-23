<?php

namespace Database\Factories;

use App\Enums\Transaction\TransactionGatewayNameEnum;
use App\Enums\Transaction\TransactionStatusEnum;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => TransactionStatusEnum::randomValue(),
            'gateway_name' => TransactionGatewayNameEnum::randomValue(),
            'amount' => random_int(500_000, 10_000_000),
            'ref_id' => fake()->uuid(),
            'token' => fake()->uuid(),
            'description' => fake()->boolean() ? $this->faker->persianText(rand(60, 220), true) : null,
            'user_id' => User::factory(),
            'order_id' => Order::factory(),
        ];
    }
}
