<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Notifications\NewFavoriteNotification;

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

        if ($vehicle->user->notificationSettings->favorites) {
            $vehicle->user->notify(new NewFavoriteNotification($vehicle, $request->user()));
        }
        return response()->json([
            'message' => 'Vehicle favorited successfully',
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
        $user_favs = $request->user()->favoriteVehicles()->count();

        $favData = $request->user()->favoriteVehicles()->when(
            $request->filled('sort'),
            function ($query) use ($request) {
                switch ($request->sort) {
                    case 'newest':
                        $query->orderby('favorites.created_at', 'desc');
                        break;
                    case 'oldest':
                        $query->orderBy('favorites.created_at', 'asc');
                        break;
                    case 'low_price':
                        $query->orderBy('price', 'asc');
                        break;
                    case 'high_price':
                        $query->orderBy('price', 'desc');
                        break;
                }
            }
        )->select(
            'id',
            'title',
            'price',
            'mileage',
            'fuel_type_id',
            'user_id',
            'country_id',
            'city_id'
        )->with(['primaryImage', 'fuelType:id,name', 'user:id,username', 'country:id,name', 'city:id,name'])->get();

        return response()->json([
            'vehicles' => $favData,
            'quantity' => $user_favs
        ], 200);
    }
}
