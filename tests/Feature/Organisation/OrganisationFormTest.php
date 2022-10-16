<?php

use App\Models\User;
use Livewire\Livewire;
use App\Models\Organisation;
use function Pest\Faker\faker;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

    beforeEach(function () {
        // Create role if it does not exist
        Role::firstOrCreate(['name' => 'SuperAdmin', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'update-org', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'create-org', 'guard_name' => 'web']);
    });


test('A SuperAdmin user can create an Organisation ', function () {

    // Create SuperAdmin user
    $this->actingAs(User::factory()->create()->assignRole('SuperAdmin'));

    Livewire::test('organisation.organisation-form')
        ->set('name', 'Urban Energy')
        ->set('contact_name', 'Peter Pike')
        ->set('contact_email', 'pikepeter@gmail.com')
        ->set('contact_phone', '+60 1121316106')
        ->call('saveOrg')
        ->assertEmitted('toggleForm')
        ->assertSessionHas('message','Organisation successfully created.');

        $this->assertTrue(Organisation::whereName('Urban Energy')->exists());
});


test('An authenticated User with "create-org" permission can create an Organisation ', function () {

    // Create an authorised user with permission
    $this->actingAs(User::factory()->create()->givePermissionTo('create-org'));

    Livewire::test('organisation.organisation-form')
        ->set('name', 'Urban Energy')
        ->set('contact_name', 'Peter Pike')
        ->set('contact_email', 'pikepeter@gmail.com')
        ->set('contact_phone', '+60 11 2131 6106')
        ->call('saveOrg')
        ->assertEmitted('toggleForm')
        ->assertSessionHas('message','Organisation successfully created.');


        $this->assertTrue(Organisation::whereName('Urban Energy')->exists());
});

test('An authenticated User without specific permission can not create an Organisation ', function () {

    // Create SuperAdmin user
    $this->actingAs(User::factory()->create());

    Livewire::test('organisation.organisation-form')
        ->set('name', 'Urban Energy')
        ->set('contact_name', 'Peter Pike')
        ->set('contact_email', 'pikepeter@gmail.com')
        ->set('contact_phone', '+60 11 2131 6106')
        // ->set('contact_phone', faker()->e164PhoneNumber())
        ->call('saveOrg')
        ->assertStatus(403);

});


test('Organisation Validation rules on save', function($field, $value, $rule){
    User::factory()->create(['email' => 'duplicate@email.com']);

    // Create an authorised user with permission
    $this->actingAs(User::factory()->create()->givePermissionTo('create-org'));

    Livewire::test('organisation.organisation-form')
    ->set($field, $value)
    ->call('saveOrg')
    ->assertHasErrors([$field => $rule]);
    })->with('org_validation');

