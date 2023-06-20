<?php

use Domain\Events\Models\Enrollment;
use Domain\Organization\Models\Organization;
use Domain\Events\Models\Event;

beforeEach(function () {
    $this->parentResource = 'events';
    $this->resource = 'enrollments';
    $this->organization = Organization::factory()->create();

    $this->be($this->organization);
});

it('can retrieve all enrollments', function() {
    $event = Event::factory()->for($this->organization)->create();

    Enrollment::factory()->for($event)->approved()->count(5)->create();
    Enrollment::factory()->for($event)->rejected()->count(5)->create();
    Enrollment::factory()->for($event)->pending()->count(5)->create();

    $response = $this->getJson($this->getEndpoint($event->slug));

    expect($response)->assertOk()
        ->and($response->json('data'))
        ->toHaveCount(10);
});

it('cant retrieve enrollments of an event from another organization', function() {
    $event = Event::factory()->create();

    Enrollment::factory()->for($event)->count(5)->create();

    $response = $this->getJson($this->getEndpoint($event->slug));

    expect($response)->assertForbidden();
});
