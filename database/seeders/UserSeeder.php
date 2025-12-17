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
    $users = [
        ['email' => 'admin@gmail.com', 'name' => 'Admin', 'role' => 'admin', 'password' => '111'],
        ['email' => 'teacher@gmail.com', 'name' => 'Teacher', 'role' => 'teacher', 'password' => '111'],
        ['email' => 'user@gmail.com', 'name' => 'User', 'role' => 'user', 'password' => '111'],
    ];

    foreach ($users as $data) {
        User::updateOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['name'],
                'role' => $data['role'],
                'password' => Hash::make($data['password']),
                'is_active' => 1, // Seeder users skip OTP
            ]
        );
    }
}

    
}
