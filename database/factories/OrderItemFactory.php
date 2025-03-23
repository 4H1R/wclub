<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = random_int(50_000, 80_000);
        $quantity = random_int(1, 10);

        return [
            'price' => $price,
            'quantity' => $quantity,
            'subtotal' => $quantity * $price,
            'order_id' => Order::factory(),
        ];
    }
}
