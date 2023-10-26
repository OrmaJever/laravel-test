<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\GetPostsRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Service\PostService;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function get(GetPostsRequest $request, PostService $postService)
    {
        $validated = $request->validated();

        $posts = $postService->get($validated, Auth::user());

        return PostResource::collection($posts);
    }

    public function create(CreatePostRequest $request, PostService $postService)
    {
        $validated = $request->validated();

        $post = $postService->create($validated, Auth::user());

        return new PostResource($post);
    }

    public function update(int $id, UpdatePostRequest $request, PostService $postService)
    {
        $validated = $request->validated();

        $post = $postService->update($id, $validated, Auth::user());

        return new PostResource($post);
    }
}
