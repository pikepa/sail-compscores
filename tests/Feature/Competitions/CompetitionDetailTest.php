<?php

use App\Models\Competition;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    //Arrange
    $this->comp = Competition::factory()->create();
    SESSION(['CLIENT_ID' => $this->comp->id]);
});

it('has Client Competition Detail page', function () {
    //Set Up
    loginAsUser()->assignRole('ClientAdmin');

    $this->get('/client/competition/'.$this->comp->id)
    ->assertOk()
    ->assertSee($this->comp->comp_name)
    ->assertSee('competition for')
    ->assertSee($this->comp->comp_type)
    ->assertSee('Events')
    ->assertSee('Competitors')
    ->assertSeeLivewire('competitions.events-component')
    ->assertSeeLivewire('competitions.competitors-component');
});

test('A guest cannot access the competition page directly', function () {
    //Act & Assert
    $this->get('/client/competition/'.$this->comp->id)
    ->assertRedirect('/login');
});

test('An User without "read-comp" permission cannot access the competition page directly', function () {
    //Act & Assert
    loginAsUser();

    $this->get('/client/competition/'.$this->comp->id)
    ->assertStatus(403);
});
