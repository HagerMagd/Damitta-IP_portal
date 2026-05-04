<?php

namespace Database\Seeders;

use App\Models\EthicsReviews;
use App\Models\researche;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class EthicsReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $researches=researche::all();
        foreach($researches as $research){
            $reviewers=User::inRandomOrder()->take(3)->get();
            foreach($reviewers as $reviewer){
               EthicsReviews::factory()->create([
                'research_id'=>$research->id,
                'reviewer_id'=> $reviewer->id,
                'decision'=>fake()->randomElement(['approve','reject']),
                'notes'=>fake()->paragraph(),

               ]);


            }
           
        }
}
}