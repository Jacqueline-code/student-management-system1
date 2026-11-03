<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Administrator account
        User::updateOrCreate(
            ['email' => 'admin@campus.test'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('Admin@12345'),
                'role' => 'admin',
            ]
        );

        // Lecturer account
        User::updateOrCreate(
            ['email' => 'lecturer@campus.test'],
            [
                'name' => 'Test Lecturer',
                'password' => Hash::make('Lecturer@12345'),
                'role' => 'lecturer',
            ]
        );

        // Student account
        User::updateOrCreate(
            ['email' => 'student@campus.test'],
            [
                'name' => 'Test Student',
                'password' => Hash::make('Student@12345'),
                'role' => 'student',
            ]
        );
    }
}
