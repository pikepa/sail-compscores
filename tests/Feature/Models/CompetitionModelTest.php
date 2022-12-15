<?php

use App\Models\Client;
use App\Models\Competition;
use App\Models\Competitor;
use App\Models\Event;

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

it('has many entries (competition_competitors)', function () {
    $competitor = Competitor::factory()
        ->has(Competition::factory()->count(2))
        ->create();

    expect($competitor->competitions)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Competition::class);
});

it('returns only competitions belonging to this client', function () {
    $client = Client::factory()
        ->has(Competition::factory()->count(3))
        ->create();

    Competition::factory()->count(10)->create();
    expect(Competition::all())
        ->tohaveCount(13);

    expect($client->competitions)
        ->toHaveCount(3);
});
