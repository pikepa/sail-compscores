<?php

use App\Models\Organisation;
use App\Models\User;

test('An authorised user can view their Organisations', function () {
    $user = User::factory()->create();
    $org = Organisation::factory()->create(['owner_id' => $user->id]);

    $this->actingAs($user)->get('/organisation')->assertOk()
    ->assertSee('My Organisations')
    ->assertSee($user->name)
    ->assertSee($org->contact_name)
    ->assertSee($org->contact_email)
    ->assertSee($org->contact_phone);
});

test('A SuperAdmin user can view any Organisation', function () {

    // Create SuperAdmin user
    $user = User::factory()->create()->assignRole('SuperAdmin');

    // Create Multiple Random Organisation
    $org = Organisation::factory()->create();

    $this->actingAs($user);

    $this->get('/organisation')->assertOk()
    ->assertSee('All Tenants')
    ->assertSee('Add New')
    ->assertSee($org->contact_name)
    ->assertSee($org->contact_email);

    $this->assertFalse($user->id == $org->owner_id);
});
