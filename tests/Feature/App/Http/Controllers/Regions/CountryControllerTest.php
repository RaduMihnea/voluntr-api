<?php

use Domain\Regions\Models\Country;

beforeEach(function () {
    $this->resource = 'countries';
});

it('can get all countries', function () {
    Country::factory()->count(3)->create();

    $response = $this->getJson($this->getEndpoint());

    expect($response)->assertOk()
        ->and($response->json())->toHaveCount(3);
});
