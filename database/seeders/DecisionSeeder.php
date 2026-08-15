<?php

namespace Database\Seeders;

use App\Models\decision;
use App\Models\researche;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DecisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $researches = researche::all();

        foreach ($researches as $research) {

            decision::factory()->create([
                'research_id'=>$research->id,
            'result' => fake()->randomElement([
                'approved',
                'rejected',
                'pending',
                
            ]),
                
            ]);
        }
    }
}
