<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Create permissions
        //  $permission1 = Permission::create(['name' => 'manage-users']);
        //  $permission2 = Permission::create(['name' => 'edit-articles']);
        //  $permission3 = Permission::create(['name' => 'view-reports']);
        //  $permission4 = Permission::create(['name' => 'delete-articles']);

        // Create roles
        Role::create(['name' => RoleEnum::ADMIN]);
        Role::create(['name' => RoleEnum::CUSTOMER]);

        // Assign permissions to roles
        // $adminRole->givePermissionTo([$permission1, $permission2, $permission3, $permission4]);
        // $customerRole->givePermissionTo([$permission2, $permission3]);


        $users = User::all();
        foreach ($users as $user) {
            // You can assign roles based on some condition here
            $user->assignRole([RoleEnum::CUSTOMER]);
        }

        // Assign roles to specific users
        $user1 = User::find(1); // Example: user with ID 1
        $user1->syncRoles([RoleEnum::ADMIN]);

    }
}
