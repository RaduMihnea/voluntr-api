<?php

use Domain\Events\Models\EventType;

beforeEach(function () {
    $this->resource = 'event-types';
});

it('can view all event-types', function () {
    EventType::factory()->count(10)->create();

    $response = $this->getJson($this->getEndpoint());

    expect($response)
        ->assertOk()
        ->and($response->json())
        ->toHaveCount(10);
});
