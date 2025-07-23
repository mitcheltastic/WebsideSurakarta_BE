<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest as ServiceRequestModel;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    public function index()
    {
        return ServiceRequestModel::latest()->paginate(20);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'requester_name' => 'required|string|max:255',
            'requester_contact' => 'nullable|string|max:255',
            'request_type' => 'required|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $serviceRequest = ServiceRequestModel::create($validated);

        return response()->json($serviceRequest, 201);
    }

    public function show(ServiceRequestModel $serviceRequest)
    {
        return $serviceRequest;
    }

    public function update(Request $request, ServiceRequestModel $serviceRequest)
    {
        $validated = $request->validate([
            'status' => 'sometimes|required|string|in:submitted,in_progress,resolved',
        ]);

        $serviceRequest->update($validated);

        return response()->json($serviceRequest);
    }

    public function destroy(ServiceRequestModel $serviceRequest)
    {
        $serviceRequest->delete();

        return response()->json(null, 204);
    }
}