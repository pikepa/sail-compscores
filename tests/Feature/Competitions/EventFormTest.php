<?php

use App\Models\Competition;
use App\Models\Event;
use App\Models\User;
use Livewire\Livewire;

test('A SuperAdmin user can create an Event', function () {
    $this->withoutExceptionHandling();

    // Create SuperAdmin user
    loginAsUser()->assignRole('SuperAdmin');

    // Create a competition
    $comp = Competition::factory()->create();

    // Set the Session CLIENT_ID
    session(['COMP_ID' => $comp->id]);

    Livewire::test('competitions.events-component-form')
        ->set('event_name', 'This Event')
        ->set('event_description', 'This event description')
        ->set('event_date', '2022-11-24')
        ->set('event_time', '09:00')
        ->set('event_type', 'Max Reps')
        ->set('event_status', 'Pending')
        ->call('saveEvent')
        ->assertEmitted('toggleMessage')
        ->assertSessionHas('message', 'Event successfully created.');

    $this->assertTrue(Event::whereEventName('This Event')->exists());
});

test('An authenticated User with "create-event" permission can create an Event', function () {
    // Set Up
    // Create comp manager
    loginAsUser()->givePermissionTo('create-event');
    // Create a competition
    $comp = Competition::factory()->create();
    // Set the Session CLIENT_ID
    session(['COMP_ID' => $comp->id]);

    // Act and Assert
    Livewire::test('competitions.events-component-form')
       ->set('event_name', 'This Event')
       ->set('event_description', 'This event description')
       ->set('event_date', '2022-11-24')
       ->set('event_time', '09:00')
       ->set('event_type', 'Max Reps')
       ->set('event_status', 'Pending')
       ->call('saveEvent')
       ->assertEmitted('toggleMessage')
      ->assertSessionHas('message', 'Event successfully created.');

    $this->assertTrue(Event::whereEventName('This Event')->exists());
});

test('An authenticated User without specific permission can not create a Competition ', function () {
    // Create a user without permissions
    loginAsUser();

    // Create a competition
    $comp = Competition::factory()->create();
    // Set the Session CLIENT_ID
    session(['COMP_ID' => $comp->id]);

    // Act and Assert
    Livewire::test('competitions.events-component-form')
        ->set('event_name', 'This event')
        ->set('event_description', 'This event description')
        ->set('event_date', '2022-11-24')
        ->set('event_time', '09:00')
        ->set('event_type', 'Max Reps')
        ->set('event_status', 'Pending')
        ->call('saveEvent')
        ->assertStatus(403);  //forbidden
});

test('Event Validation rules on save', function ($field, $value, $rule) {

    // Create an authorised user with permission
    loginAsUser()->givePermissionTo('create-event');

    Livewire::test('competitions.events-component-form')
    ->set($field, $value)
    ->call('saveEvent')
    ->assertHasErrors([$field => $rule]);
})->with('event_validation');
