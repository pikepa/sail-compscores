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

test('A guest cannot access the my Client home page directly', function () {
    //Arrange
    $client = Client::factory()
        ->has(User::factory())
        ->create();

    //Act & Assert
    $this->get('/client/home/'.$client->id)->assertRedirect('/login');
});

test('The Client home page can render the Competitions livewire component and display records', function () {
    //Arrange
    $client = Client::factory()
        ->has(User::factory())
        ->create();
    //Set up the session to allow the scope to act.
    $this->session(['CLIENT_ID' => $client->id]);

    $competition = Competition::factory()->create([
        'client_id' => $client->id,
        'released_at' => now(),
        'isPublic' => 1, //true
    ]);


    loginAsUser($client->user)->assignRole('ClientAdmin');

    $component = Livewire::test(CompetitionsComponent::class);

    $component->assertStatus(200)
    ->assertSee(['Competition Name', 'Date', 'Venu', 'Type', 'Events'])
    ->assertSee($competition->display_name)
    ->assertSee('(P)')
    ->assertSee($competition->comp_venu);
});

test('The Client home page can render the Users livewire component and display records', function () {
    // Create an Client for which we want to look at Users
    $client = Client::factory()
        ->has(User::factory())
        ->create();

    //Set up the session to allow the scope to act.
    $this->session(['CLIENT_ID' => $client->id]);

    // Create a client User to list for this client and attach to client
    $created_user = User::factory()->create([
        'client_id' => $client->id,
    ]);

    $client->client_users()->attach([$created_user->id]);

    // Act & Assert
    loginAsUser($client->user)->assignRole('ClientAdmin');

    $component = Livewire::test(UsersComponent::class);

    $component->assertStatus(200)
    ->assertSee(['Name', 'Email', 'Roles', 'Status'])
    ->assertSee($created_user->name)
    ->assertSee($created_user->email);
    // ->assertSee($client_user->roles)
    // ->assertSee($client_user->status);
});
