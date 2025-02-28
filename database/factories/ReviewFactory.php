<?php

namespace Database\Factories;

use App\Models\OrderItem;
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
        $orderItemIds = OrderItem::pluck('id')->toArray();
        return [
            //
            'product_id' => rand(1, 10),
            'user_id' => rand(1, 10),
            'order_item_id' => $this->faker->randomElement($orderItemIds),
            'comment' => $this->faker->paragraph,
            'rating' => rand(1,5),
        ];
    }
}
