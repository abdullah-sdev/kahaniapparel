<?php

namespace Database\Seeders;

use App\Models\CargoCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CargoCompany::factory()->count(50)->create();
    }
}
