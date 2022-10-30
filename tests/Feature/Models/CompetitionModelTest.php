<?php

use App\Models\Event;
use App\Models\Client;
use App\Models\Athlete;
use App\Models\Competition;

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
        ->has(Competition::factory()->count(2), 'athlete_competitions')
        ->create();
    expect($athlete->athlete_competitions)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Competition::class);
});
    