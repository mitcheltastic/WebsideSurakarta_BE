<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // Get all settings as a key-value object
    public function index()
    {
        return Setting::all()->pluck('value', 'key');
    }

    // Update multiple settings at once
    public function store(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array'
        ]);

        foreach ($validated['settings'] as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return response()->json(['message' => 'Settings saved successfully.']);
    }
}