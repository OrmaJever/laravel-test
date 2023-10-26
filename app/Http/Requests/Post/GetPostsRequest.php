<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class GetPostsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|integer',
            'offset' => 'sometimes|integer|min:0',
            'limit' => 'sometimes|integer|between:1,100',
            'sort' => 'sometimes|string|in:asc,desc',
            'created_at' => 'sometimes|date',
            'text' => 'sometimes|string|max:255'
        ];
    }
}
