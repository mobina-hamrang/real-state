<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Permission::create(['name' => '']);
//        Permission::create(['name' => '']);
//        Permission::create(['name' => '']);

        $adminRole = Role::create(['name' => 'Admin']);
        $visitorRole = Role::create(['name' => 'Visitor']);
        $userRole = Role::create(['name' => 'User']);

//        $adminRole->givePermissionTo([
//        ]);
//
//        $visitorRole->givePermissionTo([
//        ]);
//
//        $userRole->givePermissionTo([
//        ]);
    }
}
