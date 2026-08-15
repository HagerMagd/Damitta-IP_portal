<?php

namespace Database\Seeders;

use App\Models\researche;
use App\Models\User;
use App\Models\vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $researches = researche::all();

    foreach ($researches as $research) {

        $users = User::inRandomOrder()
            ->take(3)
            ->get();

        foreach ($users as $user) {

            vote::factory()->create([

                'research_id' => $research->id,

                'user_id' => $user->id,

                'comment' => fake()->sentence(),

                'vote' => fake()->randomElement([
                    'approved',
                    'rejected',
                    'pending',
                ]),
            ]);
        }
    }
}
}