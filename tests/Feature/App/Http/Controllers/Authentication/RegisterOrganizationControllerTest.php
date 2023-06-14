<?php

beforeEach(function () {
    $this->resource = 'register-organization';
});

it('can register an organization', function () {
    $response = $this->postJson($this->getEndpoint(), getOrganizationData());

    expect($response)
        ->assertCreated()
        ->whereAllTypes([
            'id' => 'integer',
            'token' => 'string',
            'name' => 'string',
            'role' => 'string',
            'email' => 'string',
        ]);
});

it('gives error if terms are not accepted', function () {
    $response = $this->postJson($this->getEndpoint(), getOrganizationData([
        'terms' => false,
    ]));

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('terms');
});

it('gives error if password too short', function () {
    $response = $this->postJson($this->getEndpoint(), getOrganizationData([
        'password' => 'pass',
    ]));

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('password');
});

it('gives error if email invalid', function () {
    $response = $this->postJson($this->getEndpoint(), getOrganizationData([
        'email' => 'john',
    ]));

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('email');
});

it('gives error if name too short', function () {
    $response = $this->postJson($this->getEndpoint(), getOrganizationData([
        'name' => 'Do',
    ]));

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('name');
});

it('translates terms in correct language', function () {
    $response = $this->postJson($this->getEndpoint(), getOrganizationData([
        'terms' => false,
    ]), ['Accept-Language' => 'fr']);

    expect($response)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('terms')
        ->assertJson([
            'message' => __('validation.accepted', ['attribute' => __('validation.attributes.terms')]),
        ]);
});

function getOrganizationData(array $attributes = [])
{
    return array_merge([
        'name' => 'Helping People',
        'email' => 'helping@people.com',
        'password' => 'password',
        'terms' => true,
    ], $attributes);
}
