<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Ahmad',
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('admin1234'),
            'role' => User::ROLE_ADMIN,
        ]);

        // Petugas
        User::create([
            'name' => 'Ahmad',
            'email' => 'petugas123@gmail.com',
            'password' => Hash::make('petugas1234'),
            'role' => User::ROLE_PETUGAS,
        ]);
    }

}
