<?php

use Domain\Organization\Models\Organization;
use Domain\Volunteer\Models\Volunteer;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

beforeEach(function () {
    $this->parentResource = 'volunteers';
    $this->resource = 'avatar';
    $this->volunteer = Volunteer::factory()->create();
});

it('can upload new avatar picture', function () {
    $this->be($this->volunteer);

    $response = $this->patch($this->getEndpoint($this->volunteer->id), [
        'file' => UploadedFile::fake()->image('avatar.jpg'),
    ], ['Content' => 'multipart/form-data']);

    expect(Media::all()->count())->toBe(1)
        ->and($this->volunteer->media()->count())
        ->toBe(1)
        ->and($response)
        ->assertOk()
        ->whereAllTypes([
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'string',
            'phone' => 'string',
            'avatar' => 'string',
        ]);
});

it('cant upload to another volunteer', function () {
    $this->be($this->volunteer);
    $anotherVolunteer = Volunteer::factory()->create();

    $response = $this->patchJson($this->getEndpoint($anotherVolunteer->id), [
        'file' => UploadedFile::fake()->image('avatar.png'),
    ], ['Content' => 'multipart/form-data']);

    expect($response)->assertForbidden();
});

it('cant upload other files', function () {
    $this->be($this->volunteer);

    $response = $this->patchJson($this->getEndpoint($this->volunteer->id), [
        'file' => UploadedFile::fake()->create('something.pdf'),
    ], ['Content' => 'multipart/form-data']);

    expect($response)->assertUnprocessable();
});
