<?php

use App\Http\Livewire\Competitions\CompetitorsComponent;
use App\Models\Competition;
use App\Models\Competitor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {

    //Arrange
    $this->comp = Competition::factory()
    ->has(Competitor::factory()->count(3))
    ->create();
});

test('A ClientAdmin can display the competitors component page and content', function () {
    //Act & Assert

    $this->withSession(['COMP_ID' => $this->comp->id]);

    loginAsUser()->assignRole('ClientAdmin');

    Livewire::test(CompetitorsComponent::class)
        ->assertSee('Competitor Name')
        ->assertSee('Entry Status')
        ->assertSee('Add Competitor')
        ->assertSee($this->comp->competitors->display_name)
        ->assertSee($this->comp->competitors->competitor_status);
});
