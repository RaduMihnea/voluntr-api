<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Http\Resources\Authentication\AuthenticationResource;
use Domain\Volunteer\Models\Volunteer;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request): JsonResource
    {
        $input = $request->only('first_name', 'last_name', 'email', 'password');
        $input['password'] = Hash::make($request['password']);

        $user = Volunteer::create($input);

        return new AuthenticationResource($user);
    }
}
