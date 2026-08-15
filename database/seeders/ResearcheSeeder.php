<?php

namespace Database\Seeders;


use App\Models\researche;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResearcheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     researche::factory(25)->create();
    }
}
