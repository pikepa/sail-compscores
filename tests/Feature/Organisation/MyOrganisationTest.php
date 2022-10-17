<?php

use App\Models\User;
use App\Models\Organisation;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


beforeEach(function () {
    // Create role if it does not exist
    Role::firstOrCreate(['name' => 'ClientAdmin', 'guard_name' => 'web']);
    Permission::firstOrCreate(['name' => 'update-org', 'guard_name' => 'web']);
});

it('has My Home page', function () {

    $user = User::factory()->create()->assignRole('ClientAdmin');
    $org = Organisation::factory()->create(['owner_id' => $user->id]);

    $this->actingAs($user)->get('/organisation/myhome/$org->id')
    ->assertOk()
    ->assertSee($org->name)
    ->assertSee('My Home Page');
});

test(' A guest cannot access the myorganisation page directly', function () {
   
    $user = User::factory()->create()->assignRole('ClientAdmin');
    $org = Organisation::factory()->create(['owner_id' => $user->id]);

    $this->get('/organisation/myhome/$org->id')->assertRedirect('/login');
});
