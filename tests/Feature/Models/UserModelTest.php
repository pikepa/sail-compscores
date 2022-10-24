<?php

use App\Models\Client;
use App\Models\User;

uses()->group('models');


it('has many clients', function () {
    $user = User::factory()
        ->has(Client::factory()->count(2))
        ->create();

    expect($user->clients)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Client::class);
});

it('has many client_users', function () {
    $user = User::factory()
        ->has(Client::factory()->count(2), 'client_users')
        ->create();

    expect($user->client_users)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Client::class);
});


