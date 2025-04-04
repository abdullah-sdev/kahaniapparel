<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Product::factory()
        ->withColorsSizesCategory()
        ->has(Gallery::factory()->count(5))
        ->count(100)
        ->create();
    }
}
