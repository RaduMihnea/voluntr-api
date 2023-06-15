<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Volunteer\ShowOrganizationRequest;
use App\Http\Requests\Volunteer\UpdateOrganizationRequest;
use Domain\Volunteer\DTOs\VolunteerProfileData;
use Domain\Volunteer\Models\Volunteer;

class VolunteerController extends Controller
{
    public function show(ShowOrganizationRequest $request, Volunteer $volunteer): VolunteerProfileData
    {
        return VolunteerProfileData::from($volunteer);
    }

    public function update(UpdateOrganizationRequest $request, Volunteer $volunteer): VolunteerProfileData
    {
        $volunteer->update($request->validated());

        return VolunteerProfileData::from($volunteer);
    }
}
