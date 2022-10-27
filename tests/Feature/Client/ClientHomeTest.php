<?php

use App\Http\Livewire\Clients\Home\CompetitionsComponent;
use App\Http\Livewire\Clients\Home\UsersComponent;
use App\Models\Client;
use App\Models\Competition;
use App\Models\User;
use Livewire\Livewire;
use function Pest\Laravel\get;

test('A client admin can see the client Home page', function () {
    //Arrange
    $client = Client::factory()
        ->has(User::factory())
        ->create();

    //Act & Assert
    loginAsUser($client->user)->assignRole('ClientAdmin');

    get('/client/home/'.$client->id)
        ->assertOk()
        ->assertSee($client->name);
});

test('A guest cannot access the my Client page directly', function () {
    //Arrange
    $client = Client::factory()
        ->has(User::factory())
        ->create();

    //Act & Assert
    $this->get('/client/home/'.$client->id)->assertRedirect('/login');
});

test('The Client home page can render the Competitions livewire componentand display records', function () {
    //Arrange
    $client = Client::factory()
        ->has(User::factory())
        ->create();
    $competition = Competition::factory()->create([
        'client_id' => $client->id,
        'released_at' => now(),
        'isPublic' => 1, //true
    ]);

    loginAsUser($client->user)->assignRole('ClientAdmin');

    $component = Livewire::test(CompetitionsComponent::class, [$client->id]);

    $component->assertStatus(200)
    ->assertSee(['Competition Name', 'Date', 'Venu', 'type', 'Organiser'])
    ->assertSee($competition->display_name)
    ->assertSee('(P)')
    ->assertSee($competition->comp_venu);
});

test('The Client home page can render the Users livewire component and display records', function () {
    // Create an Client for which we
    // want to look at Users
    $client = Client::factory()
        ->has(User::factory())
        ->create();

    $client_user = User::factory()->create([
            'client_id' => $client->id,
        ]);
    
    loginAsUser($client->user)->assignRole('ClientAdmin');

    $component = Livewire::test(UsersComponent::class, [$client->id]);

    $component->assertStatus(200)
    ->assertSee(['Name', 'Email', 'Phone'])
    ->assertSee($client_user->name)
    ->assertSee($client_user->email)
    ->assertSee($client_user->phone);
});
