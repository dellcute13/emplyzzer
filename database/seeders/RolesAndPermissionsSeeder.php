<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'add-user',
            'manage-users',
            'write-data',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign existing permissions

        // Manager: has all permissions
        $managerRole = Role::firstOrCreate(['name' => 'Manager']);
        $managerRole->syncPermissions(Permission::all());

        // Administrator: can do all except add-user
        $adminRole = Role::firstOrCreate(['name' => 'Administrator']);
        $adminRole->syncPermissions([
            'manage-users',
            'write-data',
        ]);

        // User: read-only, has no write permissions
        $userRole = Role::firstOrCreate(['name' => 'User']);
        $userRole->syncPermissions([]);
    }
}
