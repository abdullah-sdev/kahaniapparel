<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word();
        $slug = Str::slug($name);
        $image = 'https://placehold.co/500/black/white?font=playfair-display&text='.$name;

        return [
            //
            'name' => $name,
            'slug' => $slug,
            'image' => $image,
        ];
    }
}
