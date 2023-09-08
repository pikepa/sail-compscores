<?php

use Livewire\Livewire;
use App\Models\Competitor;
use App\Models\Competition;
use App\Models\CompetitionCompetitor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Factories\CompetitionCompetitorFactory;
use App\Http\Livewire\Competitions\CompetitorsComponent;

uses(RefreshDatabase::class);

beforeEach(function () {

    //Arrange
    $this->comp = Competition::factory()
    ->has(Competitor::factory()->count(1))
    ->create();
});


test('A SuperUser can display the competitors component page and content', function () {
    //Act & Assert

    $this->withSession(['COMP_ID' => $this->comp->id]);

    loginAsUser()->assignRole('SuperAdmin');

    Livewire::test(CompetitorsComponent::class)
        ->assertSee('Competitor Name')
        ->assertSee('Entry Status')
        ->assertSee('Add Competitor')
        ->assertSee($this->comp->competitors->count(1))
        ->assertSeeText($this->comp->competitors->first()->display_name);
    });

test('A ClientAdmin can display the competitors component page and content', function () {
    //Act & Assert

    $this->withSession(['COMP_ID' => $this->comp->id]);

    loginAsUser()->assignRole('ClientAdmin');

    Livewire::test(CompetitorsComponent::class)
        ->assertSee('Competitor Name')
        ->assertSee('Entry Status')
        ->assertSee('Add Competitor')
        ->assertSee($this->comp->competitors->count(3))
        ->assertSeeText($this->comp->competitors->first()->display_name)
        ->assertSeeText($this->comp->competitors->first()->created_at->format('D, jS M Y'));
    });


test('An ordinary user cannot display the competitors component page and content', function () {
    //Act & Assert

    $this->withSession(['COMP_ID' => $this->comp->id]);

    loginAsUser();

    Livewire::test(CompetitorsComponent::class)
    ->assertStatus(403);
    });

test('An guest cannot display the competitors component page and content', function () {
    //Act & Assert

    $this->withSession(['COMP_ID' => $this->comp->id]);

    Livewire::test(CompetitorsComponent::class)
    ->assertStatus(403);
    });

test('When a team competitor is displayed one can see the team name', function(){
   //Act & Assert
   $this->withSession(['COMP_ID' => $this->comp->id]);
   $competitor=Competitor::factory()->create([
        'is_team' => true,
        'team_name' => 'Test Team',
        'first_name' => null,
        'surname' => null,
   ]);
   CompetitionCompetitor::factory()->create([
        'competitor_id' => $competitor->id,
        'competition_id' => Session('COMP_ID'),
   ]);

   loginAsUser()->assignRole('ClientAdmin');

   Livewire::test(CompetitorsComponent::class)
        ->assertSee($this->comp->competitors->count(4))
        ->assertSeeText('Test Team');
});

test('When a team competitor is displayed one can see the entry date from the competition_competitor file', function(){
   //Act & Assert
   $this->withSession(['COMP_ID' => $this->comp->id]);

   $competitor=Competitor::factory()->create();

   $entry = CompetitionCompetitor::factory()->create([
        'competitor_id' => $competitor->id,
        'competition_id' => Session('COMP_ID'),
        'entry_status' => 'Paid',
   ]);
   loginAsUser()->assignRole('ClientAdmin');

   Livewire::test(CompetitorsComponent::class)
        ->assertSee($this->comp->competitors->count(4))
        ->assertSee('Paid')
        ->assertSee($entry->created_at->format('D, jS M Y'));
});

test('when a Client Admin Deletes a competitor, it is only deleted from the Competition', function(){
    //Act & Assert
    $this->withSession(['COMP_ID' => $this->comp->id]);

    expect(CompetitionCompetitor::all())->tohaveCount(1);

    loginAsUser()->assignRole('ClientAdmin');

    Livewire::test(CompetitorsComponent::class)
        ->call('deleteCompetitor',CompetitionCompetitor::first()->competitor_id);
        
        expect(CompetitionCompetitor::all())->tohaveCount(0);
        expect(Competitor::all())->tohaveCount(1);


 });

