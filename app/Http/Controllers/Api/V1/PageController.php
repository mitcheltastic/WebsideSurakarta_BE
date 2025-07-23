<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        return Page::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $page = Page::create($validated);

        return response()->json($page, 201);
    }

    public function show($slug)
    {
        return Page::where('slug', $slug)->firstOrFail();
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|nullable|string',
        ]);

        if (isset($validated['title'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $page->update($validated);

        return response()->json($page);
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return response()->json(null, 204);
    }
}