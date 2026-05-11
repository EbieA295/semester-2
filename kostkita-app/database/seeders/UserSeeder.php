<?php

namespace Database\Seeders;

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
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@kostkita.com'],
            [
                'name' => 'Admin KostKita',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'no_hp' => '081234567890',
            ]
        );

        // Owner (Pemilik)
        User::updateOrCreate(
            ['email' => 'owner@kostkita.com'],
            [
                'name' => 'Pemilik Kost',
                'password' => Hash::make('password123'),
                'role' => 'owner',
                'no_hp' => '081234567891',
            ]
        );

        // Customer
        User::updateOrCreate(
            ['email' => 'customer@kostkita.com'],
            [
                'name' => 'Budi Customer',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'no_hp' => '081234567892',
            ]
        );
    }
}
