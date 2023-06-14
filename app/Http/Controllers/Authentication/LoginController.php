<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use Domain\Authentication\DTOs\UserData;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): JsonResponse|UserData
    {
        if (! $this->attemptLogin($request)) {
            return $this->respondUnAuthenticated(__('validation.invalid_credentials'));
        }

        $user = auth()->user() ?? auth('organizations')->user();

        return UserData::from($user);
    }

    private function attemptLogin(LoginRequest $request): bool
    {
        return auth('volunteers')->attempt($request->only('email', 'password')) ||
            auth('organizations')->attempt($request->only('email', 'password'));
    }
}
