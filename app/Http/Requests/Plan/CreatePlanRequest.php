<?php

namespace App\Http\Requests\Plan;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlanRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:20',
            'price' => 'required|numeric|min:0',
            'publication_count' => 'required|numeric|min:0',
            'is_active' => 'sometimes|boolean'
        ];
    }
}
