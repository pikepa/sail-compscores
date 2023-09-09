<?php

namespace Database\Seeders;

use App\Models\Competition;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create Random competitions with events and competitors
        Competition::factory()->count(5)
        ->hasEvents(5)
        ->hasCompetitors(5)
        ->create(['client_id' => 2]);
    }
}
