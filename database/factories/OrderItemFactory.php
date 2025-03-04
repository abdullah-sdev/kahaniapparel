<?php

namespace Database\Factories;

use App\Models\Color;
use App\Models\Order;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $orderId = Order::pluck('id');
        $product = Product::pluck('id');
        $size = Size::pluck('name');
        $color = Color::pluck('name');
        return [
            //
            'order_id' => $orderId->random(),
            'product_id' => $product->random(),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'quantity' => $this->faker->numberBetween(1, 5),
            'product_attributes' => json_encode(['size' => $this->faker->randomElement(['S', 'M', 'L']), 'color' => $this->faker->safeColorName()]),
        ];
    }
}
