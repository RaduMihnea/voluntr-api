<?php

use Domain\Organization\Models\Organization;
use Domain\Regions\Models\City;

beforeEach(function () {
    $this->resource = 'organizations';
    $this->organization = Organization::factory()->create();
});

it('can view current profile', function () {
    $this->be($this->organization);

    $response = $this->getJson($this->getEndpoint($this->organization->id));

    expect($response)
        ->assertOk()
        ->whereAllTypes([
            'name' => 'string',
            'email' => 'string',
            'avatar' => 'string',
        ]);
});

it('cant view profile of another organization', function () {
    $this->be($this->organization);
    $anotherOrganization = Organization::factory()->create();

    $response = $this->getJson($this->getEndpoint($anotherOrganization->id));

    expect($response)->assertForbidden();
});

it('it can update profile', function () {
    $this->be($this->organization);

    $response = $this->patchJson($this->getEndpoint($this->organization->id), getOrganizationProfileData());

    expect($response)->assertOk();
});

it('cant update profile of another organization', function () {
    $this->be($this->organization);
    $anotherOrganization = Organization::factory()->create();

    $response = $this->patchJson($this->getEndpoint($anotherOrganization->id), getOrganizationProfileData());

    expect($response)->assertForbidden();
});

it('fails if city_id is not present', function () {
    $this->be($this->organization);

    $response = $this->patchJson($this->getEndpoint($this->organization->id), getOrganizationProfileData([
        'city_id' => null,
    ]));

    expect($response)->assertJsonValidationErrors('city_id');
});

it('fails if summary is not present', function () {
    $this->be($this->organization);

    $response = $this->patchJson($this->getEndpoint($this->organization->id), getOrganizationProfileData([
        'summary' => null,
    ]));

    expect($response)->assertJsonValidationErrors('summary');
});

it('fails if description is not present', function () {
    $this->be($this->organization);

    $response = $this->patchJson($this->getEndpoint($this->organization->id), getOrganizationProfileData([
        'description' => null,
    ]));

    expect($response)->assertJsonValidationErrors('description');
});

function getOrganizationProfileData(array $attributes = [])
{
    return array_merge([
        'name' => 'Helping People',
        'city_id' => City::factory()->create()->id,
        'summary' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'description' => fake()->paragraph(),
    ], $attributes);
}
