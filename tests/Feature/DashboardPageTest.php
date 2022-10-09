<?php

use App\Models\User;

test(' A guest cannot access the dashboard directly',function(){
    $this->get('/dashboard')->assertRedirect('/login');
});

test(' A signed in user can access the Dashboard', function(){
    $user = User::factory()->create();

    $this->actingAs($user)->get('/dashboard')->assertOk()
    ->assertSee('Dashboard');
});
