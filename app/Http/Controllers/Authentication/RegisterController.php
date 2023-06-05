<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Http\Resources\Authentication\AuthenticationResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request): JsonResource
    {
        $input = $request->only('name', 'email', 'password');
        $input['password'] = Hash::make($request['password']);

        $user = User::create($input);

        return new AuthenticationResource($user);
    }
}
