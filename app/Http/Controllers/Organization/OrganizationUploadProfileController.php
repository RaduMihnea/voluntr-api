<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\UploadOrganizationAvatarRequest;
use Domain\Organization\DTOs\OrganizationProfileData;
use Domain\Organization\Models\Organization;

class OrganizationUploadProfileController extends Controller
{
    public function __invoke(UploadOrganizationAvatarRequest $request, Organization $Organization)
    {
        $Organization->addMediaFromRequest('file')->toMediaCollection('avatar');

        return OrganizationProfileData::from($Organization);
    }
}
