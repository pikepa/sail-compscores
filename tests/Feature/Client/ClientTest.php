<?php

use App\Models\Client;
use App\Models\Competition;
use App\Models\User;

test('An authorised user can view their Organisations', function () {
    //Arrange
    $client = Client::factory()
        ->has(User::factory())
        ->create();

    //Act & Assert
    loginAsUser($client->user)->assignRole('ClientAdmin');

    $this->get('/client')->assertOk()
        ->assertSee('My Organisations')
        ->assertSee($client->user->name)
        ->assertSee($client->contact_name)
        ->assertSee($client->contact_email)
        ->assertSee($client->contact_phone);
});

test('A SuperAdmin user can view any Organisation', function () {
    //Arrange
    $client = Client::factory()
        ->has(User::factory())
        ->create();

    //Act & Assert
    $user = loginAsUser()->assignRole('SuperAdmin');

    $this->get('/client')->assertOk()
    ->assertSee('All Tenants')
    ->assertSee('Add New')
    ->assertSee($client->contact_name)
    ->assertSee($client->contact_email);

    $this->assertFalse($user->id == $client->owner_id);
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
