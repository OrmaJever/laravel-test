<?php

namespace App\Http\Requests\Plan;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:20',
            'price' => 'sometimes|numeric|min:0',
            'publication_count' => 'sometimes|numeric|min:0',
            'is_active' => 'sometimes|boolean'
        ];
    }
}
