<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $userIds = User::pluck('id')->toArray();

        Address::factory()->count(50)->create([
            'user_id' => $userIds[array_rand($userIds)],
        ]);

        // Address::factory()->count(50)->create();
    }
}
