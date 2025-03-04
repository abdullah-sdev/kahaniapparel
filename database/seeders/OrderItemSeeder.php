<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $orderIds = Order::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        OrderItem::factory()->count(rand(100, 200))->create([
            'order_id' => $orderIds[array_rand($orderIds)],
            'product_id' => $productIds[array_rand($productIds)],
        ]);

    }
}
