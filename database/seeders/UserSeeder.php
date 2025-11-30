<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin TokoKu',
            'email' => 'admin@tokoku.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Kasir 1',
            'email' => 'kasir@tokoku.com',
            'password' => Hash::make('password'),
            'role' => 'cashier',
            'is_active' => true,
        ]);
    }
}