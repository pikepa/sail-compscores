<?php

use App\Models\Competition;
use App\Models\Competitor;
use App\Models\Event;

uses()->group('models');

it('belongs to a competition', function () {
    $comp = Competition::factory()->create();
    $event = Event::factory()->create(['competition_id' => $comp->id]);
    expect($event->competition)->toBeInstanceOf(Competition::class);
});

it('has many results (competitor_events)', function () {
    $comp = Competition::factory()->create();
    $event = Event::factory()
        ->has(Competitor::factory()->count(2))
        ->create(['competition_id' => $comp->id]);

    expect($event->competitors)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Competitor::class);
});
