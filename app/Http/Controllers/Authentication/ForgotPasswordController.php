<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\ForgotPasswordRequest;
use Domain\Volunteer\Models\Volunteer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function __invoke(ForgotPasswordRequest $request): JsonResponse
    {
        Password::broker($this->getGuard($request->input('email')))->sendResetLink($request->only('email'));

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
