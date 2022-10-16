l<?php

it('has users/manageusers page', function () {
    $response = $this->get('/users/manageusers');

    $response->assertStatus(200);
});
