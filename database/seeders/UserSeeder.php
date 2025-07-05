<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@stockify.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Manajer Gudang',
            'email' => 'manajer@stockify.com',
            'password' => Hash::make('password'),
            'role' => 'manajer',
        ]);

        User::create([
            'name' => 'Staff Gudang',
            'email' => 'staff@stockify.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);
    }
}
