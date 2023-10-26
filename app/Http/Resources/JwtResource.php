<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class JwtResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'status' => 'success',
            'access_token' => $this->resource,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ];
    }
}
