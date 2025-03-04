<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $productIds = Product::pluck('id')->toArray();
        $reviewIds = Review::pluck('id')->toArray();

        Gallery::factory()->count(100)->create([
            'imageable_id' => $productIds[array_rand($productIds)],
            'imageable_type' => Product::class,
        ]);

        Gallery::factory()->count(100)->create([
            'imageable_id' => $reviewIds[array_rand($reviewIds)],
            'imageable_type' => Review::class,
        ]);
        // Gallery::factory()->count(100)->create();
    }
}
