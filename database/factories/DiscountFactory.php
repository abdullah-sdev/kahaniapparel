<?php

namespace Database\Factories;

use App\Enums\DiscountStatusEnum;
use App\Enums\DiscountTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
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
            'code' => $this->faker->unique()->regexify('[A-Z0-9]{8}'),
            'start_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'usage_limit' => $this->faker->numberBetween(70, 100),
            'usage_count' => $this->faker->numberBetween(0, 80),
            'status' => $this->faker->randomElement(DiscountStatusEnum::cases()),
            'type' => $this->faker->randomElement(DiscountTypeEnum::cases()),
            'value' => $this->faker->numberBetween(1, 100),
        ];
    }
}
