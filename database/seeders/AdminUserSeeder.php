<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo tài khoản Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Tạo tài khoản User thường
        User::create([
            'name' => 'User Demo',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

    }
}
