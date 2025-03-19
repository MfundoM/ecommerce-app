<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminData = [
            'name' => 'Admin User',
            'email' => 'admin@technest.com',
            'mobile' => '1234567890',
            'password' => Hash::make('password@123'),
            'utype' => 'ADM',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        \App\Models\User::create($adminData);
    }
}
