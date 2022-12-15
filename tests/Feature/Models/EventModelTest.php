<?php

use App\Models\Competition;
use App\Models\Competitor;
use App\Models\Event;

uses()->group('models');

it('belongs to a competition', function () {
    $event = Event::factory()
     ->has(Competition::factory())
     ->create();

    expect($event->competition)->toBeInstanceOf(Competition::class);
});

it('has many results (competitor_events)', function () {
    $this->withoutExceptionHandling();
    $event = Event::factory()
        ->has(Competitor::factory()->count(2))
        ->create();

    expect($event->competitors)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Competitor::class);
});
