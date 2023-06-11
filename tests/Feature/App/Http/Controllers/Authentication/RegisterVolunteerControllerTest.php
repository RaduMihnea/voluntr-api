<?php

beforeEach(function () {
    $this->resource = 'register';
});

it('can register a user', function () {
    $response = $this->postJson($this->getEndpoint(), getVolunteerData());

    expect($response)
        ->assertCreated()
        ->whereAllTypes([
            'id' => 'integer',
            'name' => 'string',
            'email' => 'string',
            'role' => 'string',
            'token' => 'string',
        ]);
});

it('gives error if terms are not accepted', function () {
    $response = $this->postJson($this->getEndpoint(), getVolunteerData([
        'terms' => false,
    ]));

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('terms');
});

it('gives error if password too short', function () {
    $response = $this->postJson($this->getEndpoint(), getVolunteerData([
        'password' => 'pass',
    ]));

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('password');
});

it('gives error if email invalid', function () {
    $response = $this->postJson($this->getEndpoint(), getVolunteerData([
        'email' => 'john',
    ]));

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('email');
});

it('gives error if name too short', function () {
    $response = $this->postJson($this->getEndpoint(), getVolunteerData([
        'first_name' => 'Do',
    ]));

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('first_name');
});

it('translates terms in correct language', function () {
    $response = $this->postJson($this->getEndpoint(), getVolunteerData([
        'terms' => false,
    ]), ['Accept-Language' => 'fr']);

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('terms')
        ->assertJson([
            'message' => __('validation.accepted', ['attribute' => __('validation.attributes.terms')]),
        ]);
});

function getVolunteerData(array $attributes = [])
{
    return array_merge([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@doe.com',
        'password' => 'password',
        'terms' => true,
    ], $attributes);
}
