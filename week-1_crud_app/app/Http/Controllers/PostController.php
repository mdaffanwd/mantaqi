<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of posts.
     * (Standard HTTP GET /posts)
     */
    public function index()
    {
        // 1. Fetch all posts, latest-first
        $posts = Post::orderBy('created_at', 'desc')->get();

        // 2. Return the index view with the posts
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     * (Standard HTTP GET /posts/create)
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post.
     * (Standard HTTP POST /posts)
     */
    public function store(StorePostRequest $request)
    {
        // 1. Validate & sanitize via StorePostRequest
        $data = $request->validated();

        // 2. Create the post
        Post::create($data);

        // 3. Redirect back with a success flash
        return redirect()
            ->route('posts.index')
            ->with('success', 'Post created successfully!');
    }

    /**
     * Display a single post.
     * (Standard HTTP GET /posts/{post})
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }


    /**
     * Show the form for editing a post.
     * (Standard HTTP GET /posts/{post}/edit)
     * We’ll fetch the form via normal HTTP, but submit via AJAX.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }


    /**
     * Update the specified post via AJAX.
     * (AJAX PUT/PATCH /posts/{post})
     */
    public function update(StorePostRequest $request, Post $post)
    {
        // 1. Validate data
        $data = $request->validated();

        // 2. Update the model
        $post->update($data);

        // 3. Return JSON so Fetch() can handle UI updates
        return response()->json([
            'message' => 'Post updated successfully',
            'post' => $post,
        ]);
    }

    /**
     * Remove the specified post via AJAX.
     * (AJAX DELETE /posts/{post})
     */
    public function destroy(Post $post)
    {
        // 1. Delete the model
        $post->delete();

        // 2. Return JSON confirmation
        return response()->json([
            'message' => 'Post deleted successfully',
        ]);
    }

}
