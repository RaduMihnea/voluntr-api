<?php

use Domain\Events\Enums\EnrollmentStateEnum;
use Domain\Events\Models\Enrollment;
use Domain\Events\Models\Event;
use Domain\Organization\Models\Organization;

beforeEach(function () {
    $this->parentResource = 'enrollments';
    $this->resource = 'change-state';
    $this->organization = Organization::factory()->create();

    $this->be($this->organization);
});

it('can switch to the correct state', function (string $from, string $to) {
    $event = Event::factory()->for($this->organization)->create();

    $enrollment = Enrollment::factory()->for($event)->create([
        'state' => $from,
    ]);

    $response = $this->patchJson($this->getEndpoint($enrollment->id), [
        'state' => $to,
    ]);

    expect($response)->assertOk();
})->with([
    [EnrollmentStateEnum::PENDING, EnrollmentStateEnum::APPROVED],
    [EnrollmentStateEnum::PENDING, EnrollmentStateEnum::REJECTED],
    [EnrollmentStateEnum::APPROVED, EnrollmentStateEnum::REJECTED],
]);

it('can not change state for another organizations event', function () {
    $enrollment = Enrollment::factory()->create([
        'state' => 'pending',
    ]);

    $response = $this->patchJson($this->getEndpoint($enrollment->id), [
        'state' => 'approved',
    ]);

    expect($response)->assertForbidden();
});

it('can not change to wrong state', function (string $from, string $to) {
    $event = Event::factory()->for($this->organization)->create();

    $enrollment = Enrollment::factory()->for($event)->create([
        'state' => $from,
    ]);

    $response = $this->patchJson($this->getEndpoint($enrollment->id), [
        'state' => $to,
    ]);

    expect($response)->assertUnprocessable();
})->with([
    [EnrollmentStateEnum::APPROVED, EnrollmentStateEnum::PENDING],
    [EnrollmentStateEnum::REJECTED, EnrollmentStateEnum::PENDING],
    [EnrollmentStateEnum::REJECTED, EnrollmentStateEnum::APPROVED],
]);
