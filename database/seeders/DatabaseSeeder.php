<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //User::factory()->create([
            //'name' => 'Test User',
            //'email' => 'test@example.com',
        //]);
        //$this->call(AdminSeeder::class);
        // ADMIN
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // Kondisi untuk cek apakah pengguna sudah ada
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]
        );
        $ownerUser = User::firstOrCreate(
            ['email' => 'owner@gmail.com'],
            [
                'name' => 'owner',
                'email' => 'owner@gmail.com',
                'password' => Hash::make('12345678'), // ganti dengan password yang diinginkan
                'role' => 'owner', // pastikan ini ditambahkan
            ]
);
    }

}
