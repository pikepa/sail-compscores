<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Competition;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    public function run(): void
    {
        //Arrange
        $client = Client::first();

        //Create Random competitions with events and competitors
        Competition::factory()->count(4)
        //Create 5 events per competition
        ->hasEvents(5)
        //create 10 competitors for each competition
        ->hasCompetitors(10)
        ->create(['client_id' => $client->id]);
    }
}
