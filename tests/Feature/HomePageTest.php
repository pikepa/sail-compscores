<?php

test('A Guest can load the home page', function () {
    $this->get('/')->assertStatus(200)
    ->assertSee('CompScores')
    ->assertSee('Log in')
    ->assertSee('Register');
});
