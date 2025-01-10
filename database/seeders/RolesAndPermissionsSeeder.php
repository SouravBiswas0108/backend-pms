<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Define roles
        $roles = [
            'admin' => ['view posts', 'create posts', 'edit posts', 'delete posts'],
            'editor' => ['view posts', 'create posts', 'edit posts'],
            'viewer' => ['view posts'],
        ];

        // Create roles and assign permissions
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }

        // Optionally, assign roles to users
        $adminUser = \App\Models\User::find(1); // Replace with a valid user ID
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }
    }
}

