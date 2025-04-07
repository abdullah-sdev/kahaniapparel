<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userID = User::pluck('id');

        return [
            //
            'user_id' => $userID->random(),
            'name' => $this->faker->name(),
            'address1' => $this->faker->streetAddress(),
            'address2' => $this->faker->secondaryAddress(),
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
            'postalCode' => $this->faker->postcode(),
        ];
    }
}
