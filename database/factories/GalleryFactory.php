<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
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
            'imageable_id' => $this->faker->numberBetween(1, 10),
            'imageable_type' => $this->faker->randomElement(['App\Models\Product', 'App\Models\Review']),
            'image_path' => $this->faker->imageUrl(640, 480, 'product'),
            'sort_order' => $this->faker->numberBetween(0, 10),
            'description' => $this->faker->optional()->paragraph,
        ];
    }
}
