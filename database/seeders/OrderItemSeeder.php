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

         // Create 10 order items with reviews using the factory
         OrderItem::factory()
         ->count(rand(10, 20)) // Number of order items to create
         ->withReviews() // This will add reviews to the order items
         ->create(); // Create and persist the order items


        // OrderItem::factory()
        //     ->count(rand(100, 200))
        //     ->make()
        //     ->each(function ($orderItem) use ($orderIds, $productIds) {
        //         $orderItem->order_id = $orderIds[array_rand($orderIds)];
        //         $orderItem->product_id = $productIds[array_rand($productIds)];
        //         $orderItem->save();
        //         $orderItem->withReviews()->saveMany(Review::factory()->count(rand(1, 5))->make());
        //     });


        // OrderItem::factory()
        // ->count(rand(100, 200))
        // ->create([
        //     'order_id' => $orderIds[array_rand($orderIds)],
        //     'product_id' => $productIds[array_rand($productIds)],
        // ]
        // )->withReviews();

    }
}
