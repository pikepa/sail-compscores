<?php

use App\Models\Client;

    test('a guest can not access the invitenewusers page', function () {
        $this->get(route('user.invite'))
        ->assertRedirect('login');
    });

    test('a non SuperAdmin or Client Admin get redirected to unauthorised page', function () {
        //Arrange
        loginAsUser();

        //Act and Assert
        $this->get(route('user.invite'))
        ->assertRedirect('not-authorised');

    });

    test('only a SuperUser can access the InviteNewUser page', function () {
        $client=Client::factory()->create();
        //Arrange
        session(['CLIENT_ID' => $client->id]);
        loginAsUser()->assignRole('SuperAdmin');
        //Act and Assert
        $this->get(route('user.invite'))
        ->assertOK();
    });

    test('a client Admin can access the invite user page', function () {
        $client=Client::factory()->create();
        //Arrange
        session(['CLIENT_ID' => $client->id]);
        loginAsUser()->assignRole('ClientAdmin');

        //Act and Assert
        $this->get(route('user.invite'))
        ->assertOK();

        });


