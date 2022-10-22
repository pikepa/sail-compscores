<?php

use App\Models\Client;
use App\Models\Competition;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create()->assignRole('ClientAdmin');
    $this->client = Client::factory()->create();
});

it('only returns released competitions for released scope', function () {
    // set up two competitions one released one not
    $releasedComp = Competition::factory()->released()->create(['client_id' => $this->client->id]);
    Competition::factory()->create(['client_id' => $this->client->id]);

    //Act and assert
    $this->actingAs($this->user);

    expect(Competition::released()->get())
    ->toHaveCount(1)
    ->first()->id->toEqual($releasedComp->id);
});
