<?php

use App\Models\User;
use App\Models\Client;
use Livewire\Livewire;
use App\Http\Livewire\Clients\Home\UsersComponent;

beforeEach(function () {
    //Arrange
    $this->client = Client::factory()
    ->has(User::factory(), 'client_users')
    ->create();

    //Set up the session to allow the scope to act.
    $this->session(['CLIENT_ID' => $this->client->id]); 
});


test('A ClientAdmin can display the UsersComponent page', function () {
    //Act & Assert
    loginAsUser()->assignRole('ClientAdmin');

    Livewire::test(UsersComponent::class)
        ->assertSee('Name')
        ->assertSee('Email')
        ->assertSee('Roles')
        ->assertSee('Status');
    
    });

    it('displays related users in descending sort order', function () {
    //Act & Assert
    loginAsUser()->assignRole('ClientAdmin');

    $userA = User::factory()->create();
    $userB = User::factory()->create();
    $userC = User::factory()->create();

    $this->client->client_users()->attach([$userA->id,$userB->id,$userC->id]);

    Livewire::test(UsersComponent::class)
        ->assertSee($userA->name)
        ->assertSee($userB->name)
        ->assertSee($userC->name);
 
    expect( $this->client->client_users)
        ->toHaveCount(4)
        ->each->toBeInstanceOf(User::class);
    
    });