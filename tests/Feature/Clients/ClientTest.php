<?php

use App\Models\Client;
use App\Models\User;

test('An authorised user can view their Organisations', function () {
    $user = User::factory()->create();
    $client = Client::factory()->create(['owner_id' => $user->id]);

    $this->actingAs($user)->get('/client')->assertOk()
    ->assertSee('My Organisations')
    ->assertSee($user->name)
    ->assertSee($client->contact_name)
    ->assertSee($client->contact_email)
    ->assertSee($client->contact_phone);
});

test('A SuperAdmin user can view any Organisation', function () {

    // Create SuperAdmin user
    $user = User::factory()->create()->assignRole('SuperAdmin');

    // Create Multiple Random Organisation
    $client = Client::factory()->create();

    $this->actingAs($user);

    $this->get('/client')->assertOk()
    ->assertSee('All Tenants')
    ->assertSee('Add New')
    ->assertSee($client->contact_name)
    ->assertSee($client->contact_email);

    $this->assertFalse($user->id == $client->owner_id);
});
