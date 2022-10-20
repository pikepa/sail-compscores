<?php

use App\Http\Livewire\Organisation\Home\Competitions;
use App\Http\Livewire\Organisation\Home\Users;
use App\Models\Competition;
use App\Models\Organisation;
use App\Models\User;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    // Create role if it does not exist
    Role::firstOrCreate(['name' => 'ClientAdmin', 'guard_name' => 'web']);
    Permission::firstOrCreate(['name' => 'read-user', 'guard_name' => 'web']);
    Permission::firstOrCreate(['name' => 'read-comp', 'guard_name' => 'web']);
    Permission::firstOrCreate(['name' => 'create-comp', 'guard_name' => 'web']);
    Permission::firstOrCreate(['name' => 'update-comp', 'guard_name' => 'web']);
});

test('A client admin can see the client Home page', function () {
    $user = User::factory()->create()->assignRole('ClientAdmin')
    ->givePermissionTo(['read-comp', 'read-user']);
    $org = Organisation::factory()->create(['owner_id' => $user->id]);

    $this->actingAs($user)->get('/organisation/home/'.$org->id)
    ->assertOk()
    ->assertSee($org->name);
});

test('A guest cannot access the myorganisation page directly', function () {
    $user = User::factory()->create()->assignRole('ClientAdmin');
    $org = Organisation::factory()->create(['owner_id' => $user->id]);

    $this->get('/organisation/home/'.$org->id)->assertRedirect('/login');
});

test('The Organisation home page can render the Competitions livewire component', function () {
    // Create an organisation for which we
    // want to look at competitions
    $org = Organisation::factory()->create();

    $component = Livewire::test(Competitions::class, [$org->id]);

    $component->assertStatus(200)
    ->assertSee(['Competition Name', 'Date', 'Venu', 'Organiser']);
});
test('The Organisation home page can render the Users livewire component', function () {
    // Create an organisation for which we
    // want to look at Users
    $org = Organisation::factory()->create();

    $component = Livewire::test(Users::class, [$org->id]);

    $component->assertStatus(200);
});

test('The organisation home page can display their own competitions', function () {
    // Create an organisation for which we
    // want to look at Competitions

    $user = User::factory()->create()->assignRole('ClientAdmin')
    ->givePermissionTo(['read-comp', 'create-comp', 'update-comp', 'read-user']);
    $org = Organisation::factory()->create();
    $comp = Competition::factory()->create(['org_id' => $org->id]);

    $this->actingAs($user);

    Livewire::test(Competitions::class, [$org->id])
        ->assertSee('Competition Name')
        ->assertSee($comp->name)
        ->assertSee('Venu')
        ->assertSee($comp->venu)
        ->assertSee('Add New');
});
