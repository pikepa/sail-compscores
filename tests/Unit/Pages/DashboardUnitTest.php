<?php

use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});


test('The Dashboard shows the Users Name', function(){

    $this->get('/dashboard')->assertSee($this->user->name);
});
test('The Dashboard shows Log Out', function(){

    $this->get('/dashboard')->assertSee('Log Out');
});

test('The Dashboard shows User Profile', function(){

    $this->get('/dashboard')->assertSee('Profile');
});

test('The Dashboard shows the the Application Name', function(){

    $this->get('/dashboard')->assertSee('CompScores | Dashboard');
}); 

 