<?php

use App\Http\Livewire\Clients\Home\Competitions;
use App\Http\Livewire\Clients\Home\CompetitionsComponent;
use App\Models\Client;
use App\Models\Competition;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    //Arrange
    $this->client = Client::factory()
    ->has(User::factory())
    ->create();
    //Set up the session to allow the scope to act.
    $this->session(['CLIENT_ID' => $this->client->id]); 
});

test('A ClientAdmin can display the competitions page', function () {
    //Act & Assert
    loginAsUser()->assignRole('ClientAdmin');

    Livewire::test(CompetitionsComponent::class, [$this->client->id])
        ->assertSee('Date')
        ->assertSee('Competition Name')
        ->assertSee('Venu')
        ->assertSee('Type')
        ->assertSee('Add New');
});

test('It shows only released competitions', function () {

    // set up two competitions one released one not
    $releasedComp = Competition::factory()->released()->create(['client_id' => $this->client->id]);
    $unreleasedComp = Competition::factory()->create(['client_id' => $this->client->id, 'released_at' => null]);

    //Act and assert
    loginAsUser();
    Livewire::test(CompetitionsComponent::class, [$this->client->id])
        ->assertSeeText($releasedComp->comp_name)
        ->assertDontSeeText($unreleasedComp->comp_name);
});

test('it shows competitions by start date descending', function () {
    // set up two competitions one starting before the other
    $earliestComp = Competition::factory()->released()->create(['client_id' => $this->client->id, 'start_date' => Carbon::yesterday()]);
    $lastComp = Competition::factory()->released()->create(['client_id' => $this->client->id, 'start_date' => Carbon::now()]);

    //Act and assert
    loginAsUser();

    Livewire::test(CompetitionsComponent::class, [$this->client->id])
        ->assertSeeTextInOrder([
            $lastComp->comp_name,
            $earliestComp->comp_name,
        ]);
});

test('a competition is identified as public when displaying the name', function () {
    // set up a competition one
    $publicComp = Competition::factory()->released()->create(['client_id' => $this->client->id, 'isPublic' => 1]);

    //Act & Assert
    loginAsUser();
    Livewire::test(CompetitionsComponent::class, [$this->client->id])
    ->assertSeeText([
        $publicComp->comp_name.' (P)',
    ]);
    //expect()->
});

it('only returns released competitions for released scope', function () {
    // set up two competitions one released one not
    $releasedComp = Competition::factory()->released()->create(['client_id' => $this->client->id]);
    Competition::factory()->create(['client_id' => $this->client->id, 'released_at' => null]);

    //Act and assert
    loginAsUser();
    expect(Competition::released()->get())
    ->toHaveCount(1)
    ->first()->id->toEqual($releasedComp->id);
});
