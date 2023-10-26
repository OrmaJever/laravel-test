<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParseAuth
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $token = $request->header('Authorization');

            if(!empty($token)) {
                $token = trim(str_replace('Bearer ', '', $token));
            }

            if(empty($token)) {
                $token = $request->input('token');
            }

            if(empty($token)) {
                throw new Exception();
            }

            $decoded = JWT::decode($token, new Key(config('auth.jwt_secret'), 'HS256'));

            if (!isset($decoded->user_id)) {
                throw new Exception();
            }

            $user = User::findOrFail($decoded->user_id);

            $user->update([
                'last_visit' => Carbon::now(),
                'last_ip'    => request()->ip()
            ]);

            Auth::setUser($user);

        } catch (Exception) {}

        return $next($request);
    }
}
