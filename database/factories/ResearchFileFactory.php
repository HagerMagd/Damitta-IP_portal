<?php

namespace Database\Factories;

use App\Models\researche;
use App\Models\ResearchFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ResearchFile>
 */
class ResearchFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'research_id' => researche::inRandomOrder()->value('id'),

            'file_name' => fake()->word() . '.pdf',

            'file_path' => 'researches/' . fake()->uuid() . '.pdf',

            'category' => fake()->randomElement([
                'main_research',
                'registration_form',
                'supporting_document',
                'ethics_document',
            ]),
        ];
    }
}
