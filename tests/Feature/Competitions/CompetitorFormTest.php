<?php

use App\Models\User;
use App\Models\Event;
use Livewire\Livewire;
use App\Models\Competitor;
use App\Models\Competition;
use App\Models\CompetitionCompetitor;

test('A SuperAdmin user can create a Competitor', function () {

    // Create SuperAdmin user
    loginAsUser()->assignRole('SuperAdmin');

    // Create a competition
    $comp = Competition::factory()->create();
    $competitor = Competitor::factory()->make();
    // Set the Session CLIENT_ID
    session(['COMP_ID' => $comp->id]);

    Livewire::test('competitions.competitors-component-form')
        ->set('first_name', $competitor->first_name)
        ->set('surname', $competitor->surname)
        ->set('gender', $competitor->gender)
        ->set('email', $competitor->email)
        ->set('competitor_dob', $competitor->competitor_dob)
        ->call('saveCompetitor')
        ->assertEmitted('toggleMessage')
       ->assertSessionHas('message', 'Competitor successfully created.');

    $this->assertTrue(Competitor::whereFirstName($competitor->first_name)->exists());
});

test('An authenticated User with "create-competitor" permission can create a Competitor', function () {

    // Create SuperAdmin user
    loginAsUser()->givePermissionTo('create-competitor');

    // Create a competition
    $comp = Competition::factory()->create();
    $competitor = Competitor::factory()->make();
    // Set the Session CLIENT_ID
    session(['COMP_ID' => $comp->id]);

    Livewire::test('competitions.competitors-component-form')
        ->set('first_name', $competitor->first_name)
        ->set('surname', $competitor->surname)
        ->set('gender', $competitor->gender)
        ->set('email', $competitor->email)
        ->set('competitor_dob', $competitor->competitor_dob)
        ->call('saveCompetitor')
        ->assertEmitted('toggleMessage')
       ->assertSessionHas('message', 'Competitor successfully created.');

    $this->assertTrue(Competitor::whereFirstName($competitor->first_name)->exists());
});


test('An authenticated User without specific permission can not create a competitor ', function () {

    // Create SuperAdmin user
    loginAsUser();

    // Create a competition
    $comp = Competition::factory()->create();
    $competitor = Competitor::factory()->make();
    // Set the Session CLIENT_ID
    session(['COMP_ID' => $comp->id]);

    Livewire::test('competitions.competitors-component-form')
        ->set('first_name', $competitor->first_name)
        ->set('surname', $competitor->surname)
        ->set('gender', $competitor->gender)
        ->set('email', $competitor->email)
        ->set('competitor_dob', $competitor->competitor_dob)
        ->call('saveCompetitor')
        ->assertStatus(403);  //forbidden
});

test('Event Validation rules on save', function ($field, $value, $rule) {

    // Create an authorised user with permission
    loginAsUser()->givePermissionTo('create-competitor');

    Livewire::test('competitions.competitors-component-form')
    ->set($field, $value)
    ->call('saveCompetitor')
    ->assertHasErrors([$field => $rule]);
})->with('competitor_validation');

test('when a competitor is added, the corresponding CompetitorCompetiton record is added', function () {
$this->withoutExceptionHandling();
    // Create authorised user
    loginAsUser()->givePermissionTo('create-competitor');

    // Create a competition
    $comp = Competition::factory()->create();
    $competitor = Competitor::factory()->make();
    // Set the Session CLIENT_ID
    session(['COMP_ID' => $comp->id]);

    Livewire::test('competitions.competitors-component-form')
        ->set('first_name', $competitor->first_name)
        ->set('surname', $competitor->surname)
        ->set('gender', $competitor->gender)
        ->set('email', $competitor->email)
        ->set('competitor_dob', $competitor->competitor_dob)
        ->call('saveCompetitor');

        expect(CompetitionCompetitor::all())->tohaveCount(1);
    });