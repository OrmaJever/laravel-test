<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Resources\JwtResource;
use App\Service\AuthService;

class AuthController extends Controller
{
    public function registration(RegistrationRequest $request, AuthService $authService)
    {
        $validated = $request->validated();

        $token = $authService->registration($validated['email'], $validated['password']);

        return new JwtResource($token);
    }

    public function login(LoginRequest $request, AuthService $authService)
    {
        $validated = $request->validated();

        $token = $authService->login($validated['email'], $validated['password']);

        return new JwtResource($token);
    }
}
