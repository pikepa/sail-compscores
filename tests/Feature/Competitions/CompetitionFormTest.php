<?php

use App\Models\Client;
use App\Models\Competition;
use App\Models\User;
use Livewire\Livewire;

test('A SuperAdmin user can create a Competition', function () {
    $this->withoutExceptionHandling();
    // Create SuperAdmin user
    loginAsUser()->assignRole('SuperAdmin');

    // Create a client
    $client = Client::factory()->create();
    // Set the Session CLIENT_ID
    session(['CLIENT_ID' => $client->id]);

    Livewire::test('clients.home.competitions-component-form')
        ->set('comp_name', 'Competition')
        ->set('comp_venue', 'Crosfit 6221')
        ->set('start_date', '2022-11-23')
        ->set('comp_type', 'Individual')
        ->call('saveComp')
        ->assertEmitted('toggleMessage')
        ->assertSessionHas('message', 'Competition successfully created.');

    $this->assertTrue(Competition::whereCompName('Competition')->exists());
});

test('An authenticated User with "create-comp" permission can create a Competition', function () {
    // Create comp manager
    loginAsUser()->givePermissionTo('create-comp');

    // Create a client
    $client = Client::factory()->create();
    // Set the Session CLIENT_ID
    session(['CLIENT_ID' => $client->id]);

    Livewire::test('clients.home.competitions-component-form')
        ->set('comp_name', 'Competition')
        ->set('comp_venue', 'Crosfit 6221')
        ->set('start_date', '2022-11-23')
        ->set('comp_type', 'Individual')
        ->call('saveComp')
        ->assertEmitted('toggleMessage')
        ->assertSessionHas('message', 'Competition successfully created.');

    $this->assertTrue(Competition::whereCompName('Competition')->exists());
});

test('An authenticated User without specific permission can not create a Competition ', function () {
    // $this->withoutExceptionHandling();
    // Create a user without permissions
    loginAsUser();

    // Create a client
    $client = Client::factory()->create();
    // Set the Session CLIENT_ID
    session(['CLIENT_ID' => $client->id]);

    Livewire::test('clients.home.competitions-component-form')
        ->set('comp_name', 'Competition')
        ->set('comp_venue', 'Crosfit 6221')
        ->set('start_date', '2022-11-23')
        ->set('comp_type', 'Individual')
        ->call('saveComp')
        ->assertStatus(403);  //forbidden
});

test('Competition Validation rules on save', function ($field, $value, $rule) {

    // Create an authorised user with permission
    loginAsUser()->givePermissionTo('create-comp');

    Livewire::test('clients.home.competitions-component-form')
    ->set($field, $value)
    ->call('saveComp')
    ->assertHasErrors([$field => $rule]);
})->with('competition_validation');
