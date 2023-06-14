<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Volunteer\UploadVolunteerAvatarRequest;
use Domain\Volunteer\DTOs\VolunteerProfileData;
use Domain\Volunteer\Models\Volunteer;

class VolunteerUploadProfileController extends Controller
{
    public function __invoke(UploadVolunteerAvatarRequest $request, Volunteer $volunteer)
    {
        $volunteer->addMediaFromRequest('file')->toMediaCollection('avatar');

        return VolunteerProfileData::from($volunteer);
    }
}
