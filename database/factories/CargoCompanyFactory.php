<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CargoCompany>
 */
class CargoCompanyFactory extends Factory
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
            'name' => $this->faker->company(),
            'code' => $this->faker->regexify('[A-Z]{3}[0-9]{3}'),
            'tax_number' => $this->faker->regexify('[0-9]{12}'),
        ];
    }
}
