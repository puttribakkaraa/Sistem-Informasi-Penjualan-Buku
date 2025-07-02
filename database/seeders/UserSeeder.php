<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun owner
        if (!User::where('email', 'owner@example.com')->exists()) {
            User::create([
                'name' => 'Owner',
                'email' => 'owner@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'owner',
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
