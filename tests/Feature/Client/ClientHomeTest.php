<?php

use App\Models\User;
use App\Models\Client;
use Livewire\Livewire;
use App\Models\Competition;
use function Pest\Laravel\get;
use App\Http\Livewire\Clients\Home\Users;
use App\Http\Livewire\Clients\Home\Competitions;

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

test('The Client home page can render the Competitions livewire component', function () {
    //Arrange
    $client = Client::factory()
        ->has(User::factory())  
        ->create();
    $competition = Competition::factory()->create([
        'client_id'=> $client->id,
        'released_at'=> now(),
    ]);
    
    loginAsUser($client->user)->assignRole('ClientAdmin');

    $component = Livewire::test(Competitions::class, [$client->id]);

    $component->assertStatus(200)
    ->assertSee(['Competition Name', 'Date', 'Venu','type', 'Organiser'])
    ->assertSee($competition->display_name)
    ->assertSee($competition->comp_venu);
});

test('The Client home page can render the Users livewire component', function () {
    // Create an Client for which we
    // want to look at Users
    $client = Client::factory()->create();

    $component = Livewire::test(Users::class, [$client->id]);

    $component->assertStatus(200);
});
