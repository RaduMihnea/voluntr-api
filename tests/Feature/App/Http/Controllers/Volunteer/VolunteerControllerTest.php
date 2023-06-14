<?php

use Domain\Regions\Models\City;
use Domain\Volunteer\Models\Volunteer;

beforeEach(function () {
    $this->resource = 'volunteers';
    $this->volunteer = Volunteer::factory()->create();
});

it('can view current profile', function () {
    $this->be($this->volunteer);

    $response = $this->getJson($this->getEndpoint($this->volunteer->id));

    expect($response)
        ->assertOk()
        ->whereAllTypes([
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'string',
            'phone' => 'string',
            'avatar' => 'string',
        ]);
});

it('cant view profile of another volunteer', function () {
    $this->be($this->volunteer);
    $anotherVolunteer = Volunteer::factory()->create();

    $response = $this->getJson($this->getEndpoint($anotherVolunteer->id));

    expect($response)->assertForbidden();
});

it('it can update profile', function () {
    $this->be($this->volunteer);

    $response = $this->patchJson($this->getEndpoint($this->volunteer->id), getVolunteerProfileData());

    expect($response)->assertOk();
});

it('cant update profile of another volunteer', function () {
    $this->be($this->volunteer);
    $anotherVolunteer = Volunteer::factory()->create();

    $response = $this->patchJson($this->getEndpoint($anotherVolunteer->id), getVolunteerProfileData());

    expect($response)->assertForbidden();
});

it('fails if phone is not present', function () {
    $this->be($this->volunteer);

    $response = $this->patchJson($this->getEndpoint($this->volunteer->id), getVolunteerProfileData([
        'phone' => null,
    ]));

    expect($response)->assertJsonValidationErrors('phone');
});

it('fails if birthday is not present', function () {
    $this->be($this->volunteer);

    $response = $this->patchJson($this->getEndpoint($this->volunteer->id), getVolunteerProfileData([
        'birthday' => null,
    ]));

    expect($response)->assertJsonValidationErrors('birthday');
});

it('fails if city_id is not present', function () {
    $this->be($this->volunteer);

    $response = $this->patchJson($this->getEndpoint($this->volunteer->id), getVolunteerProfileData([
        'city_id' => null,
    ]));

    expect($response)->assertJsonValidationErrors('city_id');
});

it('fails if summary is not present', function () {
    $this->be($this->volunteer);

    $response = $this->patchJson($this->getEndpoint($this->volunteer->id), getVolunteerProfileData([
        'summary' => null,
    ]));

    expect($response)->assertJsonValidationErrors('summary');
});

it('fails if description is not present', function () {
    $this->be($this->volunteer);

    $response = $this->patchJson($this->getEndpoint($this->volunteer->id), getVolunteerProfileData([
        'description' => null,
    ]));

    expect($response)->assertJsonValidationErrors('description');
});

function getVolunteerProfileData(array $attributes = [])
{
    return array_merge([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'phone' => '555-555-555',
        'birthday' => '1990-01-01',
        'city_id' => City::factory()->create()->id,
        'summary' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'description' => fake()->paragraph(),
    ], $attributes);
}
