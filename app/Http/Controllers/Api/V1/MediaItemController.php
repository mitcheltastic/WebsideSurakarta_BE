<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\MediaItem;
use Illuminate\Http\Request;
// Note: To handle file uploads, you would also use: use Illuminate\Support\Facades\Storage;

class MediaItemController extends Controller
{
    public function index()
    {
        return MediaItem::latest()->paginate(20);
    }

    public function store(Request $request)
    {
        // A real implementation would handle file uploads and generate the path.
        // For now, we assume the path is provided.
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'caption' => 'nullable|string',
            'file_path' => 'required|string|max:255',
            'media_type' => 'required|string|in:photo,video',
        ]);

        $mediaItem = MediaItem::create($validated);

        return response()->json($mediaItem, 201);
    }

    public function show(MediaItem $mediaItem)
    {
        return $mediaItem;
    }

    public function update(Request $request, MediaItem $mediaItem)
    {
        $validated = $request->validate([
            'title' => 'sometimes|nullable|string|max:255',
            'caption' => 'sometimes|nullable|string',
        ]);

        $mediaItem->update($validated);

        return response()->json($mediaItem);
    }

    public function destroy(MediaItem $mediaItem)
    {
        // A real implementation would also delete the file from storage.
        // Storage::delete($mediaItem->file_path);
        $mediaItem->delete();

        return response()->json(null, 204);
    }
}