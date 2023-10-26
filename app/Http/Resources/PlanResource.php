<?php

namespace App\Http\Resources;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /* @var Plan $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'publication_count' => $this->publication_count,
            'is_active' => $this->is_active
        ];
    }
}
