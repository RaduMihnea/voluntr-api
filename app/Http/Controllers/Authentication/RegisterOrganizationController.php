<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RegisterOrganizationRequest;
use Domain\Authentication\DTOs\UserData;
use Domain\Organization\Models\Organization;

class RegisterOrganizationController extends Controller
{
    public function __invoke(RegisterOrganizationRequest $request): UserData
    {
        $organization = Organization::create($request->getData()->toArray());

        return UserData::from($organization);
    }
}
