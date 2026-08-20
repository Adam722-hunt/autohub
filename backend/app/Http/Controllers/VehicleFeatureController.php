<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use App\Models\Vehicle;
class VehicleFeatureController extends Controller
{
    public function atachFeature(Vehicle $vehicle, Request $request)
    {
        if ($vehicle->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unathorized'
            ], 403);
        }

        $data = $request->validate([
            'feature_id' => 'required|exists:features,id'
        ]);

        $vehicle->features()->syncWIthoutDetaching([
            $data['feature_id']
        ]);
        return response()->json([
            'message' => 'Feature attached successfully',
            'features' => $vehicle->features,
        ], 200);
    }

    public function detachFeature(Vehicle $vehicle, Request $request ,Feature $feature)
    {
        if ($vehicle->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unathorized'
            ], 403);
        }

        if(!$vehicle->features()->where('feature_id',$feature->id)->exists()){
            return response()->json([
                'message'=>'Feature is not attached to this vehicle'
            ],404);
        }

        $vehicle->features()->detach($feature);

        return response()->json([
            'message'=>'Feature dettached successfully',
        ],200);
    }
}
