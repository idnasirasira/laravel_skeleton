<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Create permissions
        $editUsers = Permission::create(['name' => 'edit users']);
        $deleteUsers = Permission::create(['name' => 'delete users']);

        // Assign permissions to roles
        $adminRole->givePermissionTo($editUsers);
        $adminRole->givePermissionTo($deleteUsers);
        $userRole->givePermissionTo($editUsers);
    }
}
