<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the 15 latest posts and paginate them
        return Post::latest()->paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author_id' => 'required|uuid|exists:profiles,id', // Make sure the author profile exists
            'type' => 'required|string|in:news,announcement,agenda',
            'status' => 'required|string|in:published,draft',
        ]);

        // Add a slug based on the title
        $validated['slug'] = Str::slug($validated['title']);

        // Create the post
        $post = Post::create($validated);

        return response()->json($post, 201); // Return the new post with a 201 Created status
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Laravel's Route Model Binding automatically finds the post by its ID.
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'type' => 'sometimes|required|string|in:news,announcement,agenda',
            'status' => 'sometimes|required|string|in:published,draft',
        ]);
        
        // If the title is being updated, update the slug as well
        if (isset($validated['title'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Update the post
        $post->update($validated);

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(null, 204); // Return an empty response with a 204 No Content status
    }
}