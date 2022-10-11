<?php

use App\Models\User;
use App\Models\Organisation;
use Spatie\Permission\Models\Role;
use Database\Seeders\RolesAndPermissionSeeder;

test('An authorised user can view their Organisations', function () {    
    $user = User::factory()->create();
    $org= Organisation::factory()->create(['owner_id' => $user->id]);

    $this->actingAs($user)->get('/organisation')->assertOk()
    ->assertSee('My Organisations')
    ->assertSee($user->name)
    ->assertSee($org->contact_name)
    ->assertSee($org->contact_email)
    ->assertSee($org->contact_phone);

});

test('A SuperAdmin user can view any Organisation', function () { 
    // Create role of it does not exist
    $role=Role::firstOrCreate(['name' =>'SuperAdmin', 'guard_name'=>'web']);
    
    // Create SuperAdmin user
    $user = User::factory()->create()->assignRole($role);

    // Create Multiple Random Organisation
    $org= Organisation::factory()->create();

    $this->actingAs($user)->get('/organisation')->assertOk()
    ->assertSee('All Organisations')
    ->assertSee('Edit');

    $this->assertfalse($user->id == $org->owner_id);


});

test('An Organisation has many competitions', function () {
    //expect()->
})->skip();





