<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\GuestBookEntryController;
use App\Http\Controllers\Api\V1\MediaItemController;
use App\Http\Controllers\Api\V1\PageController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\ServiceRequestController;
use App\Http\Controllers\Api\V1\SettingController;
use App\Http\Controllers\Api\V1\VillageOfficialController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// This is a default route for checking the authenticated user's info.
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Group all API version 1 routes under the 'v1' prefix.
// Example URL: yourdomain.com/api/v1/posts
Route::prefix('v1')->group(function () {
    Route::apiResource('profiles', ProfileController::class);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('village-officials', VillageOfficialController::class);
    Route::apiResource('media-items', MediaItemController::class);
    Route::apiResource('service-requests', ServiceRequestController::class);
    Route::apiResource('guest-book-entries', GuestBookEntryController::class);
    Route::apiResource('pages', PageController::class);
    Route::apiResource('settings', SettingController::class);
});