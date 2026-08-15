<?php

namespace Database\Seeders;

use App\Models\committee;
use App\Models\CommitteeMember;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommitteeMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $commttiees = committee::all();
        foreach ($commttiees as $commttiee) {
            $users = User::inRandomOrder()->take(3)->get();
            foreach ($users as $user) {
                CommitteeMember::factory()->create([
                    'committee_id' =>$commttiee->id,
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
