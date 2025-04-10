<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Color;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

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
        $name = $this->faker->unique()->sentence(3);
        $slug = Str::slug($name);
        $image = 'https://placehold.co/500/gray/white?font=playfair-display&text='.$slug;

        return [
            //
            'name' => $name,
            'slug' => $slug,
            'actual_price' => $this->faker->numberBetween(1000, 10000),
            'discounted_price' => $this->faker->numberBetween(1, 9999),
            'description' => $this->faker->paragraph(),
            'thumbnail_image' => $image.'1',
            'thumbnail_image1' => $image.'2',
            'clicks' => $this->faker->numberBetween(0, 100),
            'is_in_stock' => $this->faker->boolean(),
            'is_enable' => $this->faker->boolean(),
        ];
    }

    public function withGallery(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'gallery' => Gallery::factory()->count(3)->make(),
            ];
        });
    }

    public function withColorsSizesCategory(): self
    {
        return $this->afterCreating(function (Product $product) {
            $product->colors()->attach(Color::inRandomOrder()->take(3)->pluck('id'));
            $product->sizes()->attach(Size::inRandomOrder()->take(3)->pluck('id'));
            $product->categories()->attach(Category::inRandomOrder()->take(3)->pluck('id'));
        });
    }
}
