<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return Profile::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|uuid',
            'full_name' => 'nullable|string|max:255',
            'avatar_url' => 'nullable|string|max:255',
        ]);

        $profile = Profile::create($validated);

        return response()->json($profile, 201);
    }

    public function show(Profile $profile)
    {
        return $profile;
    }

    public function update(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'full_name' => 'sometimes|required|string|max:255',
            'avatar_url' => 'sometimes|nullable|string|max:255',
        ]);

        $profile->update($validated);

        return response()->json($profile);
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();

        return response()->json(null, 204);
    }
}