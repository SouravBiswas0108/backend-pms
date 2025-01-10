<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            'view data',
            'create data',
            'edit data',
            'delete data',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Define roles with their permissions
        $roles = [
            'Total User' => ['view data', 'create data', 'edit data', 'delete data'],
            'Total Department' => ['view data', 'create data', 'edit data', 'delete data'],
            'Employee Performance Rating By Grade Level' => ['view data', 'create data', 'edit data', 'delete data'],
            'Employee Performance Rating Score By Department' => ['view data', 'create data', 'edit data', 'delete data'],
            'Top 30 Employees By Performance Rating' => ['view data', 'create data', 'edit data', 'delete data'],
            'Bottom 30 Employees By Performance Rating' => ['view data', 'create data', 'edit data', 'delete data'],
            'Report On Overall Training Needs' => ['view data', 'create data', 'edit data', 'delete data'],
            'Report On Training Needs By Department' => ['view data', 'create data', 'edit data', 'delete data'],
            'Report On Employees Percentage Distribution' => ['view data', 'create data', 'edit data', 'delete data'],
        ];

        // Create roles and assign permissions
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }

        // Optionally, assign a role to a user (replace with a valid user ID)
        $adminUser = \App\Models\User::find(1);
        if ($adminUser) {
            $adminUser->assignRole('Total User'); // Assigning 'Total User' role to the admin
        }
    }
}
