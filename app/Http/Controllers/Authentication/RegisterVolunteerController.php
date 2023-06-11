<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RegisterVolunteerRequest;
use Domain\Authentication\DTOs\UserData;
use Domain\Volunteer\Models\Volunteer;

class RegisterVolunteerController extends Controller
{
    public function __invoke(RegisterVolunteerRequest $request): UserData
    {
        $volunteer = Volunteer::create($request->getData()->toArray());

        return UserData::from($volunteer);
    }
}
