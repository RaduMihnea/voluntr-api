<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Resources\Authentication\AuthenticationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): JsonResponse|JsonResource
    {
        if (! auth()->attempt($request->only('email', 'password'))) {
            return $this->respondUnAuthenticated(__('validation.invalid_credentials'));
        }

        $user = $request->user();

        return new AuthenticationResource($user);
    }
}
