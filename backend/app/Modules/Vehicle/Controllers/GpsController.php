<?php

namespace App\Modules\Vehicle\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\GpsLog;
use App\Events\GpsLocationUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GpsController extends Controller
{
    public function update(Request $request, $vehicleId)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'speed' => 'nullable|numeric',
            'heading' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $vehicle = Vehicle::findOrFail($vehicleId);

        // Update vehicle's current position
        $vehicle->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // Log history
        GpsLog::create([
            'vehicle_id' => $vehicle->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'speed' => $request->speed,
            'heading' => $request->heading,
            'recorded_at' => now(),
        ]);

        // Broadcast for real-time tracking
        broadcast(new GpsLocationUpdated($vehicle->id, $request->latitude, $request->longitude));

        return response()->json(['message' => 'Location updated and broadcasted']);
    }

    public function history($vehicleId)
    {
        $logs = GpsLog::where('vehicle_id', $vehicleId)
            ->orderBy('recorded_at', 'desc')
            ->paginate(50);

        return response()->json($logs);
    }
}
