<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\SocialiteRequest;
use App\Http\Resources\Authentication\AuthenticationResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function __invoke(SocialiteRequest $request): JsonResource
    {
        /** @phpstan-ignore-next-line */
        $providerUser = Socialite::driver($request->provider)->userFromToken($request->provider_token);

        $user = User::firstOrCreate([
            'email' => $providerUser->getEmail(),
        ], [
            'name' => $providerUser->getName(),
        ]);

        return new AuthenticationResource($user);
    }
}
