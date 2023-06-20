<?php

use Domain\Badges\Models\Badge;
use Domain\Volunteer\Models\Volunteer;

beforeEach(function () {
    $this->resource = 'badges';
    $this->volunteer = Volunteer::factory()->create();

    $this->be($this->volunteer);
});

it('can view all bages', function () {
    Badge::factory()->count(20)->create();

    $response = $this->getJson($this->getEndpoint());

    expect($response)
        ->assertOk()
        ->and($response->json())
        ->toHaveCount(20);
});
