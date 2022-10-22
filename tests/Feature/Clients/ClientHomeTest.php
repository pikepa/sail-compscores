<?php

use App\Http\Livewire\Clients\Home\Competitions;
use App\Http\Livewire\Clients\Home\Users;
use App\Models\Client;
use App\Models\User;
use Livewire\Livewire;

test('A client admin can see the client Home page', function () {
    $user = User::factory()->create()->assignRole('ClientAdmin')
    ->givePermissionTo(['read-comp', 'read-user']);
    $client = Client::factory()->create(['owner_id' => $user->id]);

    $this->actingAs($user)->get('/client/home/'.$client->id)
    ->assertOk()
    ->assertSee($client->name);
});

test('A guest cannot access the my Client page directly', function () {
    $user = User::factory()->create()->assignRole('ClientAdmin');
    $client = Client::factory()->create(['owner_id' => $user->id]);

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
