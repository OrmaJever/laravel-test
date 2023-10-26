<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /* @var Post $this */
        return [
            'id' => $this->id,
            'text' => $this->text,
            'user_id' => $this->user_id,
            'is_active' => $this->is_active
        ];
    }
}
