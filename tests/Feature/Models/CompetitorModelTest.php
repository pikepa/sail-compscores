<?php

use App\Models\Competition;
use App\Models\Competitor;
use App\Models\Event;

uses()->group('models');

it('has many competitor_events (results)', function () {
    $event = Event::factory()
        ->has(Competitor::factory()->count(2))
        ->create();

    expect($event->competitors)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Competitor::class);
});

it('has many competition_competitors', function () {
    $competition = Competition::factory()
        ->has(Competitor::factory()->count(2))
        ->create();

    expect($competition->competitors)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Competitor::class);
});
