<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\VillageOfficial;
use Illuminate\Http\Request;

class VillageOfficialController extends Controller
{
    public function index()
    {
        return VillageOfficial::orderBy('display_order')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo_path' => 'nullable|string|max:255',
            'display_order' => 'nullable|integer',
        ]);

        $official = VillageOfficial::create($validated);

        return response()->json($official, 201);
    }

    public function show(VillageOfficial $villageOfficial)
    {
        return $villageOfficial;
    }

    public function update(Request $request, VillageOfficial $villageOfficial)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'position' => 'sometimes|required|string|max:255',
            'photo_path' => 'sometimes|nullable|string|max:255',
            'display_order' => 'sometimes|nullable|integer',
        ]);

        $villageOfficial->update($validated);

        return response()->json($villageOfficial);
    }

    public function destroy(VillageOfficial $villageOfficial)
    {
        $villageOfficial->delete();

        return response()->json(null, 204);
    }
}