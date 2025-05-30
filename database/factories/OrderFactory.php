<?php

namespace Database\Factories;

use App\Enums\OrderTrackingStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\PaymentTypeEnum;
use App\Models\Address;
use App\Models\CargoCompany;
use App\Models\Discount;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::pluck('id')->toArray();
        $selectedUserId = $this->faker->randomElement($userId);
        $addressId = Address::where('user_id', $selectedUserId)->pluck('id')->toArray();
        $discountId = Discount::whereColumn('usage_limit', '>', 'usage_count')
            ->where('status', 'active')
            ->where('end_date', '>=', now())
            ->pluck('id')
            ->toArray();
        $cargoCompanyId = CargoCompany::pluck('id')->toArray();
        // $paymentStatuses =

        return [
            //
            'user_id' => $selectedUserId,
            'address_id' => $this->faker->randomElement($addressId),
            'payment_status' => $this->faker->randomElement(PaymentStatusEnum::cases()),
            'order_status' => $this->faker->randomElement(OrderTrackingStatusEnum::cases()),
            'payment_type' => $this->faker->randomElement(PaymentTypeEnum::cases()),
            'tracking_number' => $this->faker->unique()->numberBetween(100000, 999999),
            'cargo_company_id' => $this->faker->randomElement($cargoCompanyId),
            'discount_id' => $this->faker->optional()->randomElement($discountId),
            'subtotal' => $this->faker->numberBetween(100, 1000),
            'delivery_cost' => $this->faker->numberBetween(10, 100),
        ];
    }

    public function withOrderItems(int $count)
    {
        return $this->afterCreating(function ($order) use ($count) {
            OrderItem::factory()->count($count)->create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
            ]);
        });
    }
}
