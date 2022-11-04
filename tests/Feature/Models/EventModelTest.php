<?php

use App\Models\Athlete;
use App\Models\Competition;
use App\Models\Event;

uses()->group('models');

it('belongs to a competition', function () {
    $event = Event::factory()
     ->has(Competition::factory())
     ->create();

    expect($event->competition)->toBeInstanceOf(Competition::class);
});

it('has many athlete_events (results)', function () {
    $event = Event::factory()
        ->has(Athlete::factory()->count(2), 'athlete_events')
        ->create();

    expect($event->athlete_events)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Athlete::class);
});
