<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Order::factory()
            ->has(
                OrderItem::factory()
                    ->count(rand(1, 10))
                    ->withReviews()
            )
            ->count(100)
            ->create();

    }
}
