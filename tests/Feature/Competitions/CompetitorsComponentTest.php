<?php

it('has competitions/competitorscomponent page', function () {
    $response = $this->get('/competitions/competitorscomponent');

    $response->assertStatus(200);
})->skip();
