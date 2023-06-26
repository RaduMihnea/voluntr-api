<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\ForgotPasswordRequest;
use Domain\Organization\Models\Organization;
use Domain\Volunteer\Models\Volunteer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function __invoke(ForgotPasswordRequest $request): JsonResponse
    {
        Password::broker($this->getGuard($request->input('email')))
            ->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (Volunteer|Organization $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                    ])->setRememberToken(Str::random(60));

                    $user->save();
                }
            );

        return $this->respondNoContent();
    }

    private function getGuard($email): string
    {
        if (Volunteer::where('email', $email)->exists()) {
            return 'volunteers';
        }

        return 'organizations';
    }
}
