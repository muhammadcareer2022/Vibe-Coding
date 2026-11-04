<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan role 'admin' tersedia
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // Akun Super Admin Filament sesuai spesifikasi Issue #4
        $superAdmin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'muhammad',
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->syncRoles([$adminRole]);

        // Demo User untuk keperluan testing
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
        $user = User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $user->syncRoles([$userRole]);
    }
}
