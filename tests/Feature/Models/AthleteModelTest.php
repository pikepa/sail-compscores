<?php

use App\Models\Event;
use App\Models\Athlete;
use App\Models\Competition;

uses()->group('models');

it('has many athlete_events (results)', function () {
    $event = Event::factory()
        ->has(Athlete::factory()->count(2), 'athlete_events')
        ->create();

    expect($event->athlete_events)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Athlete::class);
});

it('has many athlete_competitions', function () {
    $competition = Competition::factory()
        ->has(Athlete::factory()->count(2), 'athlete_competitions')
        ->create();

    expect($competition->athlete_competitions)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Athlete::class);
});
