<?php

use Domain\Organization\Models\Organization;
use Domain\Volunteer\Models\Volunteer;

beforeEach(function () {
    $this->resource = 'login';
    $this->volunteer = Volunteer::factory()->create([
        'password' => Hash::make('password'),
    ]);
});

it('can login a volunteer', function () {
    $response = $this->postJson($this->getEndpoint(), [
        'email' => $this->volunteer->email,
        'password' => 'password',
    ]);

    expect($response)
        ->assertCreated()
        ->whereAllTypes([
            'token' => 'string',
            'profile' => 'array',
        ]);
});

it('can login an organization', function () {
    $organization = Organization::factory()->create();

    $response = $this->postJson($this->getEndpoint(), [
        'email' => $organization->email,
        'password' => 'password',
    ]);

    expect($response)
        ->assertCreated()
        ->whereAllTypes([
            'token' => 'string',
            'profile' => 'array',
        ]);
});

it('gives error if password too short', function () {
    $response = $this->postJson($this->getEndpoint(), [
        'email' => $this->volunteer->email,
        'password' => 'wrong',
    ]);

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('password');
});

it('gives error if email invalid', function () {
    $response = $this->postJson($this->getEndpoint(), [
        'email' => 'john',
    ]);

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('email');
});

it('returns unauthorized if wrong credentials', function () {
    $response = $this->postJson($this->getEndpoint(), [
        'email' => $this->volunteer->email,
        'password' => 'wrong-password',
    ]);

    expect($response)->assertUnauthorized();
});
