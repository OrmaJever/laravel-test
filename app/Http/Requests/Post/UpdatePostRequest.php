<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'text' => 'sometimes|string',
            'is_active' => 'sometimes|boolean'
        ];
    }
}
