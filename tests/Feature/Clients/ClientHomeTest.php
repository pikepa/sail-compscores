<?php

use App\Models\User;
use App\Models\Client;
use Livewire\Livewire;
use App\Models\Competition;
use App\Http\Livewire\Clients\Home\Users;
use App\Http\Livewire\Clients\Home\Competitions;


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

test('The Client home page can display their own competitions', function () {
    // Create an Client for which we
    // want to look at Competitions
$this->withoutExceptionHandling();
    $user = User::factory()->create()->assignRole('ClientAdmin')
    ->givePermissionTo(['read-comp', 'create-comp', 'update-comp', 'read-user']);
    $client = Client::factory()->create();
    $comp = Competition::factory()->create(['client_id' => $client->id]);

    $this->actingAs($user);

    Livewire::test(Competitions::class, [$client->id])
        ->assertSee('Date')
        ->assertSee($comp->formatted_date)   
        ->assertSee('Competition Name')
        ->assertSee($comp->name)
        ->assertSee('Venu')
        ->assertSee($comp->venu)
        ->assertSee('Type')
        ->assertSee($comp->type)
        

        ->assertSee('Add New');
});
