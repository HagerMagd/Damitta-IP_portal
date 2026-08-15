<?php

namespace Database\Seeders;

use App\Models\admin;
use App\Models\role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        admin::create([
            'name'=>'Super Admin',
            'email'=>'admin@gmail.com',
            'password'=>'123456789',
            'image_path'=>'assets/images/admins/admin.jpg',
            'role_id'=>role::where('role_name','admin')->value("id"),
        ]);

    }
}
