<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
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

        $this->call([
            UserRolesAndPermissionsSeeder::class,
            UserSeeder::class,  // is with Address
            // AddressSeeder::class,
            // GallerySeeder::class,
            ColorSeeder::class,
            CategorySeeder::class,
            SizeSeeder::class,
            CargoCompanySeeder::class,
            ProductSeeder::class, // is with Gallery
            DiscountSeeder::class,
            WishlistSeeder::class,
            OrderSeeder::class,
            // OrderItemSeeder::class,
            // ReviewSeeder::class,
        ]);

        // Assign roles to specific users
        $user1 = User::find(1); // Example: user with ID 1
        $user1->syncRoles([RoleEnum::ADMIN]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
