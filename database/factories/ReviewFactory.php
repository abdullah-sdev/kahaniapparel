<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $orderItemIds = OrderItem::pluck('id')->toArray();
        // $orderItem = OrderItem::find($this->faker->randomElement($orderItemIds));
        // $userId = $orderItem ? $orderItem->order->user_id : null;

        return [
            //
            // 'product_id' => $orderItem->product_id,
            // 'user_id' => $userId,
            // 'order_item_id' => $orderItem->id,
            'order_item_id' => OrderItem::inRandomOrder()->first()->id, // Randomly associate with an order item
            'product_id' => Product::inRandomOrder()->first()->id, // Randomly associate with a product
            'user_id' => User::inRandomOrder()->first()->id, // Randomly associate with a user
            'comment' => $this->faker->paragraph,
            'rating' => rand(1, 5),
        ];
    }
}
