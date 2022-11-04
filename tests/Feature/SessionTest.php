<?php

use App\Models\Client;
use App\Models\User;
use function Pest\Laravel\get;

it('Client id session variable is set whenever the client page is selected', function () {
    //Arrange
    $key = 'CLIENT_ID';
    $client = Client::factory()
    ->has(User::factory())
    ->create();

    //Act & Assert
    loginAsUser($client->user)->assignRole('ClientAdmin');

    get('/client/home/'.$client->id)
        ->assertOK()
        ->assertSessionHas('CLIENT_ID', $client->id)
        ->assertSessionHas('APP_PAGE_TITLE', $client->name);
});
