<?php

use App\Models\Client;
use App\Models\Competition;
use App\Models\User;
use function Pest\Laravel\get;

it('Client id session variable is set whenever the client page is selected', function () {
    //  $this->withoutExceptionHandling();
    //Arrange
    $key = 'CLIENT_ID';
    $client = Client::factory()
    ->has(User::factory())
    ->create();

    //Act & Assert
    loginAsUser($client->owner)->assignRole('ClientAdmin');

    get('/client/home/'.$client->id)
        ->assertOK()
        ->assertSessionHas('CLIENT_ID', $client->id)
        ->assertSessionHas('COMP_ID', '')
        ->assertSessionHas('APP_PAGE_TITLE', $client->name);
});

    test('the Session variable COMP_ID is set when the CompetitionDetail page is loaded', function () {

          //Arrange
        $key = 'CLIENT_ID';
        $client = Client::factory()
          ->has(User::factory())
          ->create();

        loginAsUser($client->owner)->assignRole('ClientAdmin');

        $comp = Competition::factory()->create();

        // Act
        get('/client/home/'.$comp->id)
          ->assertOK()
          ->assertSessionHas('CLIENT_ID', )
          ->assertSessionHas('COMP_ID', )
          ->assertSessionHas('APP_PAGE_TITLE', $client->name);
        //Assert
    });
