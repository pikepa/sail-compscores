<?php

use App\Models\User;
use App\Models\Organisation;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


beforeEach(function () {
    // Create role if it does not exist
    Role::firstOrCreate(['name' => 'ClientAdmin', 'guard_name' => 'web']);
    Permission::firstOrCreate(['name' => 'read-user', 'guard_name' => 'web']);
    Permission::firstOrCreate(['name' => 'read-comp', 'guard_name' => 'web']);
});

test('a client admin can see the client Home page', function () {

    $user = User::factory()->create()->assignRole('ClientAdmin')
    ->givePermissionTo(['read-comp','read-user']);
    $org = Organisation::factory()->create(['owner_id' => $user->id]);


    $this->actingAs($user)->get('/organisation/home/'.$org->id)
    ->assertOk()
    ->assertSee($org->name);
});

test(' A guest cannot access the myorganisation page directly', function () {
   
    $user = User::factory()->create()->assignRole('ClientAdmin');
    $org = Organisation::factory()->create(['owner_id' => $user->id]);

    $this->get('/organisation/home/'.$org->id)->assertRedirect('/login');
});
