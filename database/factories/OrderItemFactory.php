<?php

namespace Database\Factories;

use App\Models\Color;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
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
    // public function definition(): array
    // {
    //     $orderId = Order::pluck('id');
    //     $product = Product::pluck('id');
    //     $size = Size::pluck('name');
    //     $color = Color::pluck('name');
    //     return [
    //         //
    //         'order_id' => $orderId->random(),
    //         'product_id' => $product->random(),
    //         'price' => $this->faker->randomFloat(2, 10, 100),
    //         'quantity' => $this->faker->numberBetween(1, 5),
    //         'product_attributes' => json_encode(['size' => $this->faker->randomElement(['S', 'M', 'L']), 'color' => $this->faker->safeColorName()]),
    //     ];
    // }
    public function definition(): array
    {
        // Randomly select existing Order, Product, Size, and Color
        $orderId = Order::inRandomOrder()->first()->id; // Get a random order ID
        $productId = Product::select('id', 'discounted_price')->inRandomOrder()->first(); // Get a random product ID
        $size = Size::inRandomOrder()->first()->name; // Get a random size name
        $color = Color::inRandomOrder()->first()->name; // Get a random color name

        return [
            'order_id' => $orderId,
            'product_id' => $productId->id,
            'price' => $productId->discounted_price,
            'quantity' => $this->faker->numberBetween(1, 5),
            'product_attributes' => ['size' => $size, 'color' => $color],
        ];
    }

    public function withReviews(): static
    {
        return $this->afterCreating(function ($orderItem) {
            // Create random reviews and associate them with the order item
            Review::factory()->count(rand(1, 5))->create([
                'order_item_id' => $orderItem->id, // Associate reviews with the created order item
                'product_id' => $orderItem->product_id,
                'user_id' => $orderItem->order->user_id,
            ]);
        });
    }

    // public function withReviews(): static
    // {
    //     return $this->state(function (array $attributes) {
    //         // Create random reviews and associate them with the order item
    //         $reviews = Review::factory()->count(rand(1, 5))->create([
    //             'order_id' => $attributes['order_id'],
    //             'product_id' => $attributes['product_id'],
    //         ]);

    //         // Return an empty array, as reviews are created outside of the state
    //         return [];
    //     });
    // }

    // public function withReviews(): static
    // {
    //     return $this->state(function (array $attributes) {
    //         $reviews = ReviewFactory::new()
    //             ->count(rand(1, 5))
    //             ->create([
    //                 'order_id' => $attributes['order_id'],
    //                 'product_id' => $attributes['product_id'],
    //                 // 'order_item_id' => $attributes['id'],
    //             ]);

    //         return [
    //             'reviews' => $reviews,
    //         ];
    //     });
    // }
}
