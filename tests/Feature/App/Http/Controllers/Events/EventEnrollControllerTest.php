<?php

use Domain\Events\Models\Enrollment;
use Domain\Events\Models\Event;
use Domain\Volunteer\Models\Volunteer;

beforeEach(function () {
    $this->parentResource = 'events';
    $this->resource = 'enroll';
    $this->volunteer = Volunteer::factory()->create();

    $this->be($this->volunteer);
});

it('can enroll in an event', function () {
   $event = Event::factory()->create([
       'minimum_participant_age' => $this->volunteer->age - 10,
   ]);

   $response = $this->postJson($this->getEndpoint($event->slug));

   expect($response)->assertCreated();
});

it('cant enroll in an event if volunteer too young', function () {
    $event = Event::factory()->create([
        'minimum_participant_age' => $this->volunteer->age + 10,
    ]);

    $response = $this->postJson($this->getEndpoint($event->slug));

    expect($response)->assertUnprocessable();
});

it('cant enroll in an event if already enrolled in the past', function () {
    $event = Event::factory()->create([
        'minimum_participant_age' => $this->volunteer->age - 10,
    ]);

    $event->enrollments()->create([
        'volunteer_id' => $this->volunteer->id,
    ]);

    $response = $this->postJson($this->getEndpoint($event->slug));

    expect($response)->assertUnprocessable();
});

it('cant enroll in an event if event is full', function () {
    $event = Event::factory()->create([
        'minimum_participant_age' => $this->volunteer->age - 10,
        'required_volunteers_amount' => 1,
    ]);

    Enrollment::factory()->for($event)->approved()->create();

    $response = $this->postJson($this->getEndpoint($event->slug));

    expect($response)->assertUnprocessable();
});
