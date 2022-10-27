<?php

use App\Models\Client;
use App\Models\User;
use Livewire\Livewire;

test('A SuperAdmin user can create a Client', function () {
    // Create SuperAdmin user
    loginAsUser()->assignRole('SuperAdmin');

    Livewire::test('clients.client-form')
        ->set('name', 'Urban Energy')
        ->set('contact_name', 'Peter Pike')
        ->set('contact_email', 'pikepeter@gmail.com')
        ->set('contact_phone', '+60 1121316106')
        ->call('saveOrg')
        ->assertEmitted('toggleForm')
        ->assertEmitted('toggleMessage')
        ->assertSessionHas('message', 'Client successfully created.');

    $this->assertTrue(Client::whereName('Urban Energy')->exists());
});

test('An authenticated User with "create-client" permission can create an Organisation ', function () {
    // Create an authorised user with permission
    loginAsUser()->givePermissionTo('create-client');

    Livewire::test('clients.client-form')
        ->set('name', 'Urban Energy')
        ->set('contact_name', 'Peter Pike')
        ->set('contact_email', 'pikepeter@gmail.com')
        ->set('contact_phone', '+60 11 2131 6106')
        ->call('saveOrg')
        ->assertEmitted('toggleForm')
        ->assertEmitted('toggleMessage')
        ->assertSessionHas('message', 'Client successfully created.');

    $this->assertTrue(Client::whereName('Urban Energy')->exists());
});

test('An authenticated User without specific permission can not create an Organisation ', function () {
    // Create SuperAdmin user
    loginAsUser();

    Livewire::test('clients.client-form')
        ->set('name', 'Urban Energy')
        ->set('contact_name', 'Peter Pike')
        ->set('contact_email', 'pikepeter@gmail.com')
        ->set('contact_phone', '+60 11 2131 6106')
        // ->set('contact_phone', faker()->e164PhoneNumber())
        ->call('saveOrg')
        ->assertStatus(403);
});

test('Client Validation rules on save', function ($field, $value, $rule) {
    User::factory()->create(['email' => 'duplicate@email.com']);

    // Create an authorised user with permission
    loginAsUser()->givePermissionTo('create-client');

    Livewire::test('clients.client-form')
    ->set($field, $value)
    ->call('saveOrg')
    ->assertHasErrors([$field => $rule]);
})->with('client_validation');
