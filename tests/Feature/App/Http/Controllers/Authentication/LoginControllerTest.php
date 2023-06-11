<?php

use Domain\Volunteer\Models\Volunteer;

beforeEach(function () {
    $this->resource = 'login';
    $this->volunteer = Volunteer::factory()->create([
        'password' => Hash::make('password'),
    ]);
});

it('can login a user', function () {
    $response = $this->postJson($this->getEndpoint(), [
        'email' => $this->volunteer->email,
        'password' => 'password',
    ]);

    expect($response)
        ->assertOk()
        ->whereAllTypes([
            'token' => 'string',
            'user' => 'array',
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
