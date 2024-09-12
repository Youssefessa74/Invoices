<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */public function run()
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Create users and assign roles
        $adminUser = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role_name' => ['admin'], // Set roles as an array
                'status' => 1 // Set status to true (active)
            ]
        );
        $adminUser->assignRole($adminRole);

        $superAdminUser = User::updateOrCreate(
            ['email' => 'super_admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role_name' => ['admin'], // Set roles as an array
                'status' => 1 // Set status to true (active)
            ]
        );
        $superAdminUser->assignRole($adminRole);

        $regularUser = User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User',
                'password' => Hash::make('password'),
                'role_name' => ['user'], // Set roles as an array
                'status' => 1 // Set status to true (active)
            ]
        );
        $regularUser->assignRole($userRole);
    }
}
