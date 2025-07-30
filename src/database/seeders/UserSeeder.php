<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat role jika belum ada
        Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        // Buat user Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );
        $superAdmin->assignRole('super_admin');

        // Buat user biasa
        $user = User::firstOrCreate(
            ['email' => 'user@admin.com'],
            [
                'name' => 'User Account',
                'password' => Hash::make('password'),
            ]
        );
        $user->assignRole('user');
    }
}