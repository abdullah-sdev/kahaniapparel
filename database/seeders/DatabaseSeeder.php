<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        $this->call([
            AddressSeeder::class,
            ProductSeeder::class,
            GallerySeeder::class,
            ColorSeeder::class,
            CategorySeeder::class,
            SizeSeeder::class,
            CargoCompanySeeder::class,
            DiscountSeeder::class,
            WishlistSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            ReviewSeeder::class,
        ]);


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
