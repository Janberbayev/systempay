<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permissions
        $permissions = [
            'view posts',
            'add posts',
            'edit posts',
            'delete posts',

            'view orders',
            'add orders',
            'edit orders',
            'delete orders',

            'view ads',
            'add ads',
            'edit ads',
            'delete ads',

            'view projects',
            'add projects',
            'edit projects',
            'delete projects',

            'view deals',
            'add deals',
            'edit deals',
            'delete deals',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Roles
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $manager = Role::firstOrCreate(['name' => 'manager', 'guard_name' => 'web']);
        $user = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        // Assign permissions
        $admin->givePermissionTo(Permission::all());
        $manager->givePermissionTo([
            'view posts',
            'add posts',
            'edit posts',
            'delete posts',

            'view orders',
            'add orders',
            'edit orders',
            'delete orders',

            'view ads',
            'add ads',
            'edit ads',
            'delete ads',

            'view projects',
            'add projects',
            'edit projects',
            'delete projects',

            'view deals',
            'add deals',
            'edit deals',
            'delete deals',
        ]);
        $user->givePermissionTo([
            'view posts',
            'add posts',
            'edit posts',

            'view orders',
            'add orders',
            'edit orders',

            'view ads',
            'add ads',
            'edit ads',

            'view projects',
            'add projects',
            'edit projects',

            'view deals',
            'add deals',
            'edit deals',
            'delete deals',
        ]);
    }
}
