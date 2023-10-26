<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'text' => 'required|string',
            'is_active' => 'required|boolean'
        ];
    }
}
