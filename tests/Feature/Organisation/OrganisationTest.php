<?php

use App\Models\User;
use App\Models\Organisation;

test('An authorised user can view their Organisations', function () {
    //$this->withoutExceptionHandling();
    
    $user = User::factory()->create();
    $org= Organisation::factory()->create(['owner_id' => $user->id]);

    $this->actingAs($user)->get('/organisation')->assertOk()
    ->assertSee('Organisation');
});

test('An Organisation has many competitions', function () {
    //expect()->
})->skip();




