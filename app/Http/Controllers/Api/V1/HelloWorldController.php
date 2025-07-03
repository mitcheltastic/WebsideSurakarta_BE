<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HelloWorldController extends Controller
{
    /**
     * Display a greeting.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        // This helper function creates a proper JSON response
        return response()->json([
            'message' => 'Hello World!',
            'status' => 'success'
        ]);
    }
}