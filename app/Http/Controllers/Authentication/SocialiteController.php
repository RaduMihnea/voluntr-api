<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\SocialiteRequest;
use Domain\Authentication\DTOs\UserData;
use Domain\Volunteer\Models\Volunteer;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function __invoke(SocialiteRequest $request): UserData
    {
        /** @phpstan-ignore-next-line */
        $providerUser = Socialite::driver($request->provider)->userFromToken($request->provider_token);

        $user = Volunteer::firstOrCreate([
            'email' => $providerUser->getEmail(),
        ], [
            'name' => $providerUser->getName(),
        ]);

        return UserData::from($user);
    }
}
