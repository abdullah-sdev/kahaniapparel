<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => rand(1, 10),
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'failed']),
            'order_status' => $this->faker->randomElement(['processing', 'shipped', 'delivered', 'cancelled']),
            'payment_type' => $this->faker->randomElement(['cash', 'credit_card']),
            'tracking_number' => $this->faker->unique()->numberBetween(100000, 999999),
            // 'order_status' => array_rand(['waiting', 'preparing', 'shipping', 'delivered', 'canceled']),
            'cargo_company_id' => rand(1, 3),
            'discount_id' => rand(1, 5),
            'subtotal' => $this->faker->numberBetween(100, 1000),
            'delivery_cost' => $this->faker->numberBetween(10, 100),
        ];
    }
}
