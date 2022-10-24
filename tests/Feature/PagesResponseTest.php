<?php

use App\Models\User;
use function Pest\Laravel\get;

test('A Guest can load the home page', function () {
    get(route('welcome'))->assertOk()
    ->assertSee('CompScores')
    ->assertSee('Log in')
    ->assertSee(route('login'));
});

test ('A logged in User sees the Client Dashboard Link', function(){
    $user = User::factory()->create();
    $this->actingAs($user);

    get(route('welcome'))->assertOk()
    ->assertSeeText('Client Dashboard')
    ->assertSee(route('clients'));

});