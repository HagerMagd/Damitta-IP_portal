<?php

namespace Database\Seeders;

use App\Models\committee;
use App\Models\specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        committee::create([
            'name'=> 'Faculty of Medicine Committee',
            'type'=>'intellectual',
            'specialization_id'=>specialization::where('name','Medicine')->value('id'),
        ]);
         committee::create([
            'name'=> 'Faculty of Law Committee',
            'type'=>'intellectual',
            'specialization_id'=>specialization::where('name','Law')->value('id'),
        ]);
         committee::create([
            'name'=> 'Faculty of Computers and Information Committee',
            'type'=>'intellectual',
            'specialization_id'=>specialization::where('name','Computer Science')->value('id'),
        ]);
         committee::create([
            'name'=> 'Faculty of Engineering Committee',
            'type'=>'intellectual',
            'specialization_id'=>specialization::where('name','Engineering')->value('id'),
        ]);
           committee::create([
            'name'=> 'Faculty of Arts',
            'type'=>'intellectual',
            'specialization_id'=>specialization::where('name','Arts')->value('id'),
        ]);
         committee::create([
            'name'=> 'Ethics Committee',
            'type'=>'ethics',
            'specialization_id'=>null,
        ]);


        

        
    }
}
