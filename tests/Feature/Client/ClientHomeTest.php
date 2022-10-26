<?php

use App\Http\Livewire\Clients\Home\Competitions;
use App\Http\Livewire\Clients\Home\Users;
use App\Models\Client;
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

test('The Client home page can render the Competitions livewire component', function () {
    // Create an Client for which we
    // want to look at competitions
    $client = Client::factory()->create();

    $component = Livewire::test(Competitions::class, [$client->id]);

    $component->assertStatus(200)
    ->assertSee(['Competition Name', 'Date', 'Venu', 'Organiser']);
});

test('The Client home page can render the Users livewire component', function () {
    // Create an Client for which we
    // want to look at Users
    $client = Client::factory()->create();

    $component = Livewire::test(Users::class, [$client->id]);

    $component->assertStatus(200);
});
