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
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@ip.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'specialization_id' => null,
            'image_path'=>'assets/images/admins/admin.jpg',
        ]);

        User::factory(30)->create();
    }
}
