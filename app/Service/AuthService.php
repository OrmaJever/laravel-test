<?php

namespace App\Service;

use App\Exceptions\ErrorResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService
{
    /**
     * @throws ErrorResponse
     */
    public function registration(string $email, string $password): string
    {
        $user = User::where('email', $email)->exists();

        if($user) {
            throw new ErrorResponse("User exist");
        }

        $user = User::create([
            'email' => $email,
            'password' => Hash::make($password),
            'name' => Str::random(10)
        ]);

        return $this->getJwtToken($user->id);
    }

    public function login(string $email, string $password)
    {
        $user = User::where('email', $email)->first();

        if(!$user || !Hash::check($password, $user->password)) {
            throw new ErrorResponse("Email or password invalid");
        }

        return $this->getJwtToken($user->id);
    }

    protected function getJwtToken(int $user_id)
    {
        return Auth::tokenById($user_id);
    }
}
