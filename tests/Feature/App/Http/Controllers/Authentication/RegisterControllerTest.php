<?php

beforeEach(function () {
    $this->resource = 'register';
});

it('can register a user', function () {
    $response = $this->postJson($this->getEndpoint(), getUserData());

    expect($response)
        ->assertCreated()
        ->whereAllTypes([
            'token' => 'string',
            'user' => 'array',
        ]);
});

it('gives error if terms are not accepted', function () {
    $response = $this->postJson($this->getEndpoint(), getUserData([
        'terms' => false,
    ]));

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('terms');
});

it('gives error if password too short', function () {
    $response = $this->postJson($this->getEndpoint(), getUserData([
        'password' => 'pass',
    ]));

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('password');
});

it('gives error if email invalid', function () {
    $response = $this->postJson($this->getEndpoint(), getUserData([
        'email' => 'john',
    ]));

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('email');
});

it('gives error if name too short', function () {
    $response = $this->postJson($this->getEndpoint(), getUserData([
        'first_name' => 'Do',
    ]));

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('first_name');
});

it('translates terms in correct language', function () {
    $response = $this->postJson($this->getEndpoint(), getUserData([
        'terms' => false,
    ]), ['Accept-Language' => 'fr']);

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('terms')
        ->assertJson([
            'message' => __('validation.accepted', ['attribute' => __('validation.attributes.terms')]),
        ]);
});

function getUserData(array $attributes = [])
{
    return array_merge([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@doe.com',
        'password' => 'password',
        'terms' => true,
    ], $attributes);
}
