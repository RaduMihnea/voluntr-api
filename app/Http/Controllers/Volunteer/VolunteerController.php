<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Volunteer\ShowVolunteerRequest;
use App\Http\Requests\Volunteer\UpdateVolunteerRequest;
use Domain\Badges\Enums\BadgeProgressSlugsEnum;
use Domain\Volunteer\DTOs\VolunteerProfileData;
use Domain\Volunteer\Models\Volunteer;

class VolunteerController extends Controller
{
    public function show(ShowVolunteerRequest $request, Volunteer $volunteer): VolunteerProfileData
    {
        return VolunteerProfileData::from($volunteer);
    }

    public function update(UpdateVolunteerRequest $request, Volunteer $volunteer): VolunteerProfileData
    {
        $volunteer->update($request->validated());

        $volunteer->registerBadgeProgress(BadgeProgressSlugsEnum::PROFILE_COMPLETED);

        return VolunteerProfileData::from($volunteer);
    }
}
