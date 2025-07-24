<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceStatus;
use Illuminate\Http\Request;

class ServiceStatusLogController extends Controller
{
    public function index($id)
    {
        $serviceStatus = ServiceStatus::with('logs')->findOrFail($id);

        return response()->json([
            'service_status' => $serviceStatus->name,
            'status' => $serviceStatus->status,
            'logs' => $serviceStatus->logs()->latest()->get(),
        ]);
    }
}
