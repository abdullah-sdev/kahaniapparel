<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'name' => $this->faker->unique()->word(),
            'price' => $this->faker->numberBetween(1000, 10000),
            'description' => $this->faker->paragraph(),
            'thumbnail_image' => $this->faker->imageUrl(),
            'thumbnail_image1' => $this->faker->imageUrl(),
            'clicks' => $this->faker->numberBetween(0, 100),
            'is_in_stock' => $this->faker->boolean(),
            'is_enable' => $this->faker->boolean(),
        ];
    }
}
