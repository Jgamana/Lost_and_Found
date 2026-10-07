<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'student@test.net'],
            [
                'name' => 'Test Student',
                'contact_number' => '09123456789',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'approved',
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'faculty@test.net'],
            [
                'name' => 'Test Faculty',
                'contact_number' => '09987654321',
                'password' => Hash::make('password123'),
                'role' => 'faculty',
                'status' => 'pending',
                'is_active' => true,
            ]
        );
    }
}