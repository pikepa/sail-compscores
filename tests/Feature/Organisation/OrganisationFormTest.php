<?php

use App\Models\User;
use Livewire\Livewire;
use App\Models\Organisation;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use function Pest\Faker\faker;

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
        ->assertEmitted('toggleForm');

        $this->assertTrue(Organisation::whereName('Urban Energy')->exists());
});


test('An authenticated User with "create-org" permission can create an Organisation ', function () {

    // Create an authorised user with permission
    $this->actingAs(User::factory()->create()->givePermissionTo('create-org'));

    Livewire::test('organisation.organisation-form')
        ->set('name', 'Urban Energy')
        ->set('contact_name', 'Peter Pike')
        ->set('contact_email', 'pikepeter@gmail.com')
        ->set('contact_phone', '+60 1121316106')
        ->call('saveOrg')
        ->assertEmitted('toggleForm');

        $this->assertTrue(Organisation::whereName('Urban Energy')->exists());
});

test('An authenticated User without specific permission can not create an Organisation ', function () {

    // Create SuperAdmin user
    $this->actingAs(User::factory()->create());

    Livewire::test('organisation.organisation-form')
        ->set('name', 'Urban Energy')
        ->set('contact_name', 'Peter Pike')
        ->set('contact_email', 'pikepeter@gmail.com')
        ->set('contact_phone', faker()->e164PhoneNumber())
        ->call('saveOrg')
        ->assertStatus(403);

});


test('Organisation Validation rules', function($field, $value, $rule){
    User::factory()->create(['email' => 'duplicate@email.com']);

    // Create an authorised user with permission
    $this->actingAs(User::factory()->create()->givePermissionTo('create-org'));

    Livewire::test('organisation.organisation-form')
    ->set($field, $value)
    ->call('saveOrg')
    ->assertHasErrors([$field => $rule]);
    })->with([
        'name is null' => ['name', null, 'required'],
        'name is Min 6 ' => ['name', 'uuuu', 'min'],
        'name is Max 30' => ['name', str_repeat('*', 31), 'max'],

        'contact_name is null' => ['contact_name', null, 'required'],
        'contact_name is Min 6 ' => ['contact_name', 'uuuu', 'min'],
        'contact_name is Max 30' => ['contact_name', str_repeat('*', 31), 'max'],

        'contact_email is required' => ['contact_email', null, 'required'],
        'contact_email is invalid ' => ['contact_email', 'this is not an email', 'email'],

        'contact_phone is null' => ['contact_phone', null, 'required'],
        // 'contact_phone is Min 6 ' => ['contact_phone', 'uuuu', 'min'],
        // 'contact_phone is Max 30' => ['contact_phone', str_repeat('*', 31), 'max'],

        'owner_id is required'=> ['owner_id', null, 'required'],
        'owner_id is an integer'=> ['owner_id', 'not a integer', 'integer'],

    ]);