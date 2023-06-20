<?php

use Domain\Events\Models\Enrollment;
use Domain\Events\Models\EventType;
use Domain\Volunteer\Models\Volunteer;

beforeEach(function () {
    $this->resource = 'enrollments';
    $this->volunteer = Volunteer::factory()->create();

    $this->be($this->volunteer);
});

it('can retrieve all enrollments', function () {
    Enrollment::factory()->for($this->volunteer)->count(50)->create();

    $response = $this->getJson($this->getEndpoint());

    expect($response)
        ->assertOk()
        ->and($response->json('data'))
        ->toHaveCount(15);
});

it('can create a new enrollment for a custom Event', function () {
    $response = $this->postJson($this->getEndpoint(), getCustomEventData());

    expect($response)
        ->assertCreated()
        ->whereAllTypes([
            'id' => 'integer',
            'name' => 'string',
            'date' => 'string',
            'event_types' => 'array',
            'state' => 'string',
        ]);
});

it('cant create a new enrollment for a custom Event is name invalid', function () {
    $response = $this->postJson($this->getEndpoint(), getCustomEventData([
        'event_name' => null,
    ]));

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('event_name');
});

it('cant create a new enrollment for a custom Event is description invalid', function () {
    $response = $this->postJson($this->getEndpoint(), getCustomEventData([
        'event_description' => null,
    ]));

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('event_description');
});

it('cant create a new enrollment for a custom Event is date invalid', function () {
    $response = $this->postJson($this->getEndpoint(), getCustomEventData([
        'event_date' => null,
    ]));

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('event_date');
});

it('cant create a new enrollment for a custom Event is event type invalid', function () {
    $response = $this->postJson($this->getEndpoint(), getCustomEventData([
        'event_type_id' => '100',
    ]));

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('event_type_id');
});

it('can delete a previous custom enrollment', function () {
   $customEnrollment = Enrollment::factory()
       ->for($this->volunteer)
       ->create([
           ...getCustomEventData(),
           'event_id' => null,
       ]);

    $response = $this->deleteJson($this->getEndpoint($customEnrollment->id));

    expect($response)->assertNoContent();
});

it('cant delete a previous verified enrollment', function () {
    $customEnrollment = Enrollment::factory()
        ->for($this->volunteer)
        ->create();

    $response = $this->deleteJson($this->getEndpoint($customEnrollment->id));

    expect($response)->assertForbidden();
});

it('cant delete enrollment of another volunteer', function () {
    $customEnrollment = Enrollment::factory()->create();

    $response = $this->deleteJson($this->getEndpoint($customEnrollment->id));

    expect($response)->assertForbidden();
});

function getCustomEventData(array $attributes = [])
{
    return array_merge([
        'event_name' => 'Some Event',
        'event_description' => fake()->paragraph(),
        'event_date' => '2023-01-01T00:00:00Z',
        'event_type_id' => EventType::factory()->create()->id
    ], $attributes);
}
