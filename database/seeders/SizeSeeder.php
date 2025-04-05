<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Size::factory()->create(['name' => 'XS']);
        Size::factory()->create(['name' => 'S']);
        Size::factory()->create(['name' => 'M']);
        Size::factory()->create(['name' => 'L']);
        Size::factory()->create(['name' => 'XL']);
        Size::factory()->create(['name' => 'XXL']);
        // Size::factory()->count(5)->create();
    }
}
