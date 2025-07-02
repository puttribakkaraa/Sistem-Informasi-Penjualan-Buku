<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
         
            User::create([
                'name' => 'superAdmin',
                'email' => 'superadmin@admin.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'), 
                'remember_token' => Str::random(10),
            ]);
        
    }
}
