<?php

it('has users/invitenewusers page', function () {
    $this->get(route('user.invite'))
    ->assertRedirect('login');
});

test('only a SuperUser or ClientAdmin can access the InviteNewUser page', function () {
    loginAsUser();

    $this->get(route('user.invite'))
    ->assertRedirect(route('not-authorised'));
});
