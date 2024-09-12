<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define permissions
        $permissions = [
            'create invoices',
            'update invoices',
            'delete invoices',
            'view invoices',
            'update invoice status',
        ];

        // Create permissions if they don't already exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Define roles and assign permissions
        $roles = [
            'admin' => [
                'create invoices',
                'update invoices',
                'delete invoices',
                'view invoices',
                'update invoice status',
            ],
            'manager' => [
                'create invoices',
                'update invoices',
                'view invoices',
                'update invoice status',
            ],
            'viewer' => [
                'view invoices',
            ],
        ];

        // Create roles and assign permissions
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            foreach ($rolePermissions as $permissionName) {
                $permission = Permission::where('name', $permissionName)->first();
                if ($permission) {
                    $role->givePermissionTo($permission);
                }
            }
        }
    }
}
