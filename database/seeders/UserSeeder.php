<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin', 'password' => Hash::make('111'), 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'teacher@gmail.com'],
            ['name' => 'Teacher', 'password' => Hash::make('111'), 'role' => 'teacher']
        );

        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            ['name' => 'User', 'password' => Hash::make('111'), 'role' => 'user']
        );
    }
}
