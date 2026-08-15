<?php

namespace Database\Seeders;

use App\Models\BlockchainLogs;
use App\Models\researche;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class BlockchainLogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $researches=researche::all();
        foreach($researches as $research){
           BlockchainLogs::factory()->create([
            'research_id'=>$research->id,
            'transaction_hash'=>fake()->sha256(),
            'type'=>Arr::random(['upload','vote','decision']),
           ]);
        }
    }
}
