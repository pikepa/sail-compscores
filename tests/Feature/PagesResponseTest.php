<?php
use function Pest\Laravel\get;

test('A Guest can load the home page', function () {
   get(route('welcome'))->assertOk()
    ->assertSee('CompScores')
    ->assertSee('Log in')
    ->assertSee('Register');
});
