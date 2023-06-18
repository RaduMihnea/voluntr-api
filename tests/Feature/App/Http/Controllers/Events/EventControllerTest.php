<?php

use Domain\Events\Models\Event;
use Domain\Events\Models\EventType;
use Domain\Organization\Models\Organization;
use Domain\Volunteer\Models\Volunteer;

beforeEach(function () {
    $this->resource = 'events';
    $this->volunteer = Volunteer::factory()->create();
    $this->organization = Organization::factory()->create();

    $this->be($this->organization);
});

it('can retrieve all events', function () {
    Event::factory()->count(50)->for($this->organization)->create();

    $response = $this->getJson($this->getEndpoint());

    expect($response)
        ->assertOk()
        ->and($response->json('data'))
        ->toHaveCount(15);
});

it('can filter event by date', function () {
    Event::factory()->for($this->organization)->count(10)->create([
        'starts_at' => now()->addDays(1),
        'ends_at' => now()->addDays(2),
    ]);
    Event::factory()->for($this->organization)->count(5)->create([
        'starts_at' => now()->addWeek(),
        'ends_at' => now()->addWeeks(2),
    ]);

    $query = $this->apiQuery()->filters([
        'date_between' => [now()->toJSON(), now()->addDays(3)->toJSON()],
    ]);
    $response = $this->getJson($this->getEndpoint(
        query: $query
    ));

    expect($response)
        ->assertOk()
        ->and($response->json('data'))
        ->toHaveCount(10);
});

it('can filter event by types', function () {
    $eventTypes = EventType::factory()->count(2)->create();

    Event::factory()->for($this->organization)->count(5)->hasAttached($eventTypes[0])->create();
    Event::factory()->for($this->organization)->count(5)->hasAttached($eventTypes[1])->create();
    Event::factory()->for($this->organization)->count(5)->create();

    $query = $this->apiQuery()->filters([
        'event_type' => $eventTypes->pluck('id')->toArray(),
    ]);
    $response = $this->getJson($this->getEndpoint(
        query: $query
    ));

    expect($response)
        ->assertOk()
        ->and($response->json('data'))
        ->toHaveCount(10);
});

it('can filter event by minimum age', function () {
    Event::factory()->for($this->organization)->count(5)->create(['minimum_participant_age' => 18]);
    Event::factory()->for($this->organization)->count(5)->create(['minimum_participant_age' => 14]);

    $query = $this->apiQuery()->filters([
        'min_age' => 18,
    ]);
    $response = $this->getJson($this->getEndpoint(
        query: $query
    ));

    expect($response)
        ->assertOk()
        ->and($response->json('data'))
        ->toHaveCount(5);
});

it('can filter event by organization id', function () {
    Event::factory()->count(5)->for($this->organization)->create();
    Event::factory()->count(5)->create();

    $query = $this->apiQuery()->filters([
        'organization_id' => $this->organization->id,
    ]);
    $response = $this->getJson($this->getEndpoint(
        query: $query
    ));

    expect($response)
        ->assertOk()
        ->and($response->json('data'))
        ->toHaveCount(5);
});

it('can delete own event', function () {
    $event = Event::factory()->for($this->organization)->create();

    $response = $this->deleteJson($this->getEndpoint($event->slug));

    expect($response)->assertNoContent();
    expect(Event::find($event->id))->toBeNull();
});

it('can not delete event for other organization', function () {
    $event = Event::factory()->create();

    $response = $this->deleteJson($this->getEndpoint($event->slug));

    expect($response)->assertForbidden();
});

function getEventData(array $attributes = [])
{
    return array_merge([
        'name' => 'Collecting Trash',
        'description' => fake()->paragraph(),
        'starts_at' => now()->addDays(1)->toJSON(),
        'ends_at' => now()->addDays(2)->toJSON(),
        'required_volunteers_amount' => 5,
        'minimum_participant_age' => 18,
    ], $attributes);
}
