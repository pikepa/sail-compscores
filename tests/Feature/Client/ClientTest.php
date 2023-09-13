<?php

use App\Models\Client;
use App\Models\Competition;
use App\Models\User;

test('An authorised user can view their Organisations', function () {
    //Arrange
    $user = User::factory()->create();
    $client_A = Client::factory()->create();
    $client_B = Client::factory()->create();

    $user->clients()->sync([$client_A->id, $client_B->id]);

    //Act & Assert
    loginAsUser($user)->assignRole('ClientAdmin');

    expect($user->clients)
    ->toHaveCount(2)
    ->each->toBeInstanceOf(Client::class);

    $this->get(route('clients'))->assertOk()
        ->assertSee('My Organisations')
        ->assertSee($client_A->name)
        ->assertSee($client_A->contact_name)
        ->assertSee($client_B->name)
        ->assertSee($client_A->contact_name);
});

test('A SuperAdmin user can view any Organisation', function () {
    //Arrange
    $client = Client::factory()
        ->has(User::factory())
        ->create();

    //Act & Assert
    $user = loginAsUser()->assignRole('SuperAdmin');

    $this->get(route('clients'))->assertOk()
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
