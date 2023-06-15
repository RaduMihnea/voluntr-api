<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\ShowOrganizationRequest;
use App\Http\Requests\Organization\UpdateOrganizationRequest;
use Domain\Organization\DTOs\OrganizationProfileData;
use Domain\Organization\Models\Organization;

class OrganizationController extends Controller
{
    public function show(ShowOrganizationRequest $request, Organization $Organization): OrganizationProfileData
    {
        return OrganizationProfileData::from($Organization);
    }

    public function update(UpdateOrganizationRequest $request, Organization $Organization): OrganizationProfileData
    {
        $Organization->update($request->validated());

        return OrganizationProfileData::from($Organization);
    }
}
