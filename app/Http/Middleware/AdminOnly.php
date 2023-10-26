<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if($user->group != User::GROUPS['ADMIN']) {
            return response()->json("Access denied", 403);
        }

        return $next($request);
    }
}
