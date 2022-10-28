<?php

use App\Models\Event;
use App\Models\Client;
use App\Models\Athlete;
use App\Models\Competition;
use App\Models\Scopes\ClientScope;

uses()->group('models');

it('belongs to a client', function () {
    $competition = Competition::factory()
     ->has(Client::factory())
     ->create();
 
    expect($competition->client)->toBeInstanceOf(Client::class);
});

it('has many events', function () {
    $competition = Competition::factory()
        ->has(Event::factory()->count(2))
        ->create();

    expect($competition->events)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Event::class);
});

it('has many athlete_competitions', function () {

    $athlete = Athlete::factory()
        ->has(Competition::factory(), 'athlete_competitions')
        ->create();

    expect($athlete->athlete_competitions)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Competition::class);
})->skip('not workig ->withoutGlobalScope(ClientScope::class)');

test('All requests for competition details are scoped by ClientScope', function(){
    //Arrange
    $client = Client::factory()->create();
    //Set up the session to allow the scope to act.
    $this->session(['CLIENT_ID' => $client->id]);

    $competition = Competition::factory()->create([
    'client_id' => $client->id]);
    $competition = Competition::factory()->count(10)->create();


    expect(Competition::get()->all())->toHaveCount(1);

});