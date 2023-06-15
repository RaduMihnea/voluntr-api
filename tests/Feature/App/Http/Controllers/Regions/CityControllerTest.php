<?php

use Domain\Regions\Models\City;

beforeEach(function () {
    $this->resource = 'cities';
});

it('can get all countries', function () {
    City::factory()->count(3)->create();

    $query = $this->apiQuery()->filters([
        'country_id' => 1,
    ]);
    $response = $this->getJson($this->getEndpoint(
        query: $query
    ));

    expect($response)->assertOk()
        ->and($response->json())->toHaveCount(1);
});

it('fails if no country id is passed', function () {
    City::factory()->count(3)->create();

    $response = $this->getJson($this->getEndpoint());

    expect($response)->assertUnprocessable()
        ->and($response->json())->toHaveKey('errors')
        ->and($response->json()['errors'])->toHaveKey('filter.country_id');
});
