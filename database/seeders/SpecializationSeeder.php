<?php

namespace Database\Seeders;

use App\Models\specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        specialization::create([
            'name' => 'Arts',
        ]);
        specialization::create([
            'name' => 'Computer Science',
        ]);

        specialization::create([
            'name' => 'Medicine',
        ]);

        specialization::create([
            'name' => 'Engineering',
        ]);

        specialization::create([
            'name' => 'Law',
        ]);
    }
}
