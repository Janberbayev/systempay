<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $admin = User::firstOrCreate(
            [
                'email' => 'admin@gmail.com',
                'phone' => '+77021105742'
            ],
            [
                'name' => 'Admin',
                'password' => Hash::make('password1'),
            ]
        );
        $admin->assignRole('admin');


        // Default user for test
        $user = User::firstOrCreate(
            [
                'email' => 'user1@gmail.com',
                'phone' => '+77014872126'
            ],
            [
                'name' => 'User',
                'password' => Hash::make('password2'),
            ]
        );
        $user->assignRole('user');
    }
}
