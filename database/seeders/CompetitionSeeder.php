<?php

namespace Database\Seeders;

use App\Models\Competition;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
   
    public function run():void
    {
        //Create Random competitions with events and competitors
        Competition::factory()->count(4)
        ->hasEvents(5)
        // ->hasCompetitors(5)
        ->create(['client_id' => 2]);
    }
}
