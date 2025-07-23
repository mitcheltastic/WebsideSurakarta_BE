<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\GuestBookEntry;
use Illuminate\Http\Request;

class GuestBookEntryController extends Controller
{
    public function index()
    {
        return GuestBookEntry::latest()->paginate(20);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $entry = GuestBookEntry::create($validated);

        return response()->json($entry, 201);
    }
    
    public function show(GuestBookEntry $guestBookEntry)
    {
        return $guestBookEntry;
    }

    public function destroy(GuestBookEntry $guestBookEntry)
    {
        $guestBookEntry->delete();

        return response()->json(null, 204);
    }
}