<?php

use App\Models\Client;
use App\Models\Invitee;

uses()->group('models');

it('belongs to a Client', function () {
    //Arrange
    $invitee = Invitee::factory()
    ->has(Client::factory())
    ->create();

    //Act & Assert
    expect($invitee->client)
        ->toBeInstanceOf(Client::class);
});
