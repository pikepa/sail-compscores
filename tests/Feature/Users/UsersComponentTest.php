<?php

use App\Http\Livewire\Clients\Home\UsersComponent;
use App\Models\Client;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    //Arrange
    $this->client = Client::factory()
    ->has(User::factory())
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
        ->assertSee('Role')
        ->assertSee('Status');
});

it('displays related users in descending sort order', function () {
    //Act & Assert
    loginAsUser()->assignRole('ClientAdmin');

    $userA = User::factory()->create();
    $userB = User::factory()->create();
    $userC = User::factory()->create();

    $this->client->users()->attach([$userA->id, $userB->id, $userC->id]);

    Livewire::test(UsersComponent::class)
        ->assertSee($userA->name)
        ->assertSee($userB->name)
        ->assertSee($userC->name);

    expect($this->client->users)
        ->toHaveCount(4)
        ->each->toBeInstanceOf(User::class);
});
