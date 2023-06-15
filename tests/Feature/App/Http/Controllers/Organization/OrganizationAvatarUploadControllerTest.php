<?php

use Domain\Organization\Models\Organization;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

beforeEach(function () {
    $this->parentResource = 'organizations';
    $this->resource = 'avatar';
    $this->organization = Organization::factory()->create();
});

it('can upload new avatar picture', function () {
    $this->be($this->organization);

    $response = $this->postJson($this->getEndpoint($this->organization->id), [
        'file' => UploadedFile::fake()->image('avatar.jpg'),
    ], ['Content' => 'multipart/form-data']);

    expect(Media::all()->count())->toBe(1)
        ->and($this->organization->media()->count())
        ->toBe(1)
        ->and($response)
        ->assertCreated()
        ->whereAllTypes([
            'name' => 'string',
            'email' => 'string',
            'avatar' => 'string',
        ]);
});

it('cant upload to another organization', function () {
    $this->be($this->organization);
    $anotherOrganization = Organization::factory()->create();

    $response = $this->postJson($this->getEndpoint($anotherOrganization->id), [
        'file' => UploadedFile::fake()->image('avatar.png'),
    ], ['Content' => 'multipart/form-data']);

    expect($response)->assertForbidden();
});

it('cant upload other files', function () {
    $this->be($this->organization);

    $response = $this->postJson($this->getEndpoint($this->organization->id), [
        'file' => UploadedFile::fake()->create('something.pdf'),
    ], ['Content' => 'multipart/form-data']);

    expect($response)->assertUnprocessable();
});
