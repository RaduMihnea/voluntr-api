<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use Domain\Volunteer\DTOs\VolunteerPublicProfileData;
use Domain\Volunteer\Models\Volunteer;

class VolunteerPublicProfileController extends Controller
{
    public function __invoke(Volunteer $volunteer): VolunteerPublicProfileData
    {
        return VolunteerPublicProfileData::from($volunteer);
    }
}
