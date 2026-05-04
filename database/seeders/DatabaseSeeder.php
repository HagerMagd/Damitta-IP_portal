<?php

namespace Database\Seeders;

use App\Models\decision;
use App\Models\vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SpecializationSeeder::class,
            CommitteeSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            ResearcheSeeder::class,
            ResearchFilesSeeder::class,
            DecisionSeeder::class,
            VoteSeeder::class,
            EthicsReviewsSeeder::class,
            CommitteeMemberSeeder::class,
            BlockchainLogsSeeder::class,
        ]);
    }
}
