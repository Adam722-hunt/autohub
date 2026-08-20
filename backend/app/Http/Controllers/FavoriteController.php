<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
class FavoriteController extends Controller
{
    public function store(Vehicle $vehicle, Request $request)
    {
        if ($vehicle->status !== 'active') {
            return response()->json([
                'message' => 'Impossible to favorite an inactive vehicle'
            ], 404);
        }
        if ($request->user()->favoriteVehicles()->where('vehicle_id', $vehicle->id)->exists()) {
            return response()->json([
                'message' => 'Vehicle already exists'
            ], 404);
        }

        $request->user()->favoriteVehicles()->syncWithoutDetaching($vehicle);

        return response()->json([
            'message' => 'Vehicle favorited successfully',
            'vehicle' => $vehicle,
        ], 201);
    }

    public function destroy(Vehicle $vehicle, Request $request)
    {
        if (!$request->user()->favoriteVehicles()->where('vehicle_id', $vehicle->id)->exists()) {
            return response()->json([
                'message' => 'Vehicle is not in your favorites',
            ], 404);
        }

        $request->user()->favoriteVehicles()->detach($vehicle);

        return response()->json([
            'message' => 'Vehicle removed from favorites successfully'
        ], 200);
    }

    public function index(Request $request)
    {
        $favData = $request->user()->favoriteVehicles()->when(
            $request->filled('sort'),function($query) use ($request){
                switch($request->sort){
                    case 'newest':
                        $query->orderby('created_at','desc');
                        break;
                    case 'low_price' : 
                        $query->orderBy('price','asc');
                        break;
                    case 'high_price' : 
                        $query->orderBy('price','desc');
                        break;
                }
            })->get();

        return response()->json([
            'vehicles' => $favData
        ], 200);
    }
}
