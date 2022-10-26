<?php

use App\Models\User;
use App\Models\Client;
use App\Models\Invitee;
use App\Models\Competition;

uses()->group('models');

    it('belongs to a User', function () {
        $client = Client::factory()
        ->has(User::factory())
        ->create();

        expect($client->user)
            ->toBeInstanceOf(User::class);  
    });

it('has many competitions', function () {
    $client = Client::factory()
        ->has(Competition::factory()->count(2))
        ->create();

    expect($client->competitions)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Competition::class);
});

it('has many client_users', function () {
    $client = Client::factory()
        ->has(User::factory()->count(2), 'client_users')
        ->create();

    expect($client->client_users)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(User::class);
});

it('has many invitees', function () {
    $client = Client::factory()
        ->has(Invitee::factory()->count(2))
        ->create();

    expect($client->invitees)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Invitee::class);
});