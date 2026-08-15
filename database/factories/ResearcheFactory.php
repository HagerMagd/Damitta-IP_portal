<?php

namespace Database\Factories;

use App\Models\committee;
use App\Models\researche;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<researche>
 */
class ResearcheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'desc' => fake()->paragraph(),
            'user_id' => User::inRandomOrder()->value('id'),
            'committee_id' => committee::inRandomOrder()->value('id'),
            'status' => fake()->randomElement(['pending', 'under_review', 'approved', 'rejected']),
            'hash' => fake()->sha256(),
        ];
    }
}
