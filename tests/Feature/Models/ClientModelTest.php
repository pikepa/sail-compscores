<?php

use App\Models\Client;
use App\Models\Competition;
use App\Models\Invitee;
use App\Models\User;

uses()->group('models');

it('belongs to a User', function () {
    $client = Client::factory()
    ->has(User::factory())
    ->create();

    expect($client->user)
        ->toBeInstanceOf(User::class);
});

it('has many competitions', function () {
    //Arrange
    $client = Client::factory()
        ->has(Competition::factory()->count(2))
        ->create();
    //Set up the session to allow the scope to act.
    $this->session(['CLIENT_ID' => $client->id]);

    //Act & Assert
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
