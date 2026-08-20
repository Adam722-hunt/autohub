<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
class VehicleController extends Controller
{
    public function index(Request $request)
    {

        $query = Vehicle::where('status', 'active');
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }
        if ($request->filled('model_id')) {
            $query->where('model_id', $request->model_id);
        }
        if ($request->filled('vehicle_type_id')) {
            $query->where('vehicle_type_id', $request->vehicle_type_id);
        }
        ;
        if ($request->filled('body_type_id')) {
            $query->where('body_type_id', $request->body_type_id);
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        if ($request->filled('condition_id')) {
            $query->where('condition_id', $request->condition_id);
        }
        if ($request->filled('transmission_id')) {
            $query->where('transmission_id', $request->transmission_id);
        }
        if ($request->filled('drivetrain_id')) {
            $query->where('drivetrain_id', $request->drivetrain_id);
        }
        if ($request->filled('fuel_type_id')) {
            $query->where('fuel_type_id', $request->fuel_type_id);
        }
        if ($request->filled('min_engine_displacement')) {
            $query->where('engine_displacement', '>=', $request->min_engine_displacement);
        }
        if ($request->filled('max_engine_displacement')) {
            $query->where('engine_displacement', '<=', $request->max_engine_displacement);
        }
        if ($request->filled('engine_cylinder_id')) {
            $query->where('engine_cylinder_id', $request->engine_cylinder_id);
        }
        if ($request->filled('aspiration_id')) {
            $query->where('aspiration_id', $request->aspiration_id);
        }
        if ($request->filled('engine_layout_id')) {
            $query->where('engine_layout_id', $request->engine_layout_id);
        }
        if ($request->filled('min_mileage')) {
            $query->where('mileage', '>=', $request->min_mileage);
        }
        if ($request->filled('max_mileage')) {
            $query->where('mileage', '<=', $request->max_mileage);
        }
        if ($request->filled('min_year')) {
            $query->where('year', '>=', $request->min_year);
        }
        if ($request->filled('max_year')) {
            $query->where('year', '<=', $request->max_year);
        }
        if ($request->filled('country_id')) {
            $query->where('country_id', $request->country_id);
        }
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'newest':

                    $query->orderBy('created_at', 'desc');

                    break;

                case 'low_price':

                    $query->orderBy('price', 'asc');

                    break;

                case 'high_price':

                    $query->orderBy('price', 'desc');

                    break;

                case 'low_mileage':

                    $query->orderBy('mileage', 'asc');

                    break;

            }
        }
        if ($request->filled('search')) {

            $search = '%' . $request->search . '%';

            $query->where(function ($q) use ($search) {
                $q->where('title', 'ILIKE', $search)
                    ->orwhere('description', 'ILIKE', $search)
                    ->orwherehas('brand', function ($brandQuery) use ($search) {
                        $brandQuery->where('name', 'ILIKE', $search);
                    })->orwherehas('model', function ($modelQuery) use ($search) {
                        $modelQuery->where('name', 'ILIKE', $search);
                    })->orwherehas('country', function ($countryQuery) use ($search) {
                        $countryQuery->where('name', 'ILIKE', $search);
                    })->orwherehas('city', function ($cityQuery) use ($search) {
                        $cityQuery->where('name', 'ILIKE', $search);
                    })->orwherehas('transmissionType', function ($tansmissionQuery) use ($search) {
                        $tansmissionQuery->where('name', 'ILIKE', $search);
                    })->orwherehas('driveTrainType', function ($driveQuery) use ($search) {
                        $driveQuery->where('name', 'ILIKE', $search);
                    })->orwherehas('bodyType', function ($bodyQuery) use ($search) {
                        $bodyQuery->where('name', 'ILIKE', $search);
                    })->orwherehas('color', function ($colorQuery) use ($search) {
                        $colorQuery->where('name', 'ILIKE', $search);
                    })->orwherehas('fuelType', function ($fuelQuery) use ($search) {
                        $fuelQuery->where('name', 'ILIKE', $search);
                    })->orwherehas('aspirationType', function ($aspirationQuery) use ($search) {
                        $aspirationQuery->where('name', 'ILIKE', $search);
                    })->orwherehas('engineLayout', function ($layoutQeury) use ($search) {
                        $layoutQeury->where('name', 'ILIKE', $search);
                    })->orwherehas('engineCyl', function ($cylQuery) use ($search) {
                        $cylQuery->where('name', 'ILIKE', $search);
                    })->orWhereHas('condition', function ($conditionQuery) use ($search) {
                        $conditionQuery->where('name', 'ILIKE', $search);
                    })->orwherehas('vehicleType', function ($typeQuery) use ($search) {
                        $typeQuery->where('name', 'ILIKE', $search);
                    })->orwherehas('features', function ($featureQuery) use ($search) {
                        $featureQuery->where('name', 'ILIKE', $search);
                    })->orwherehas('vehicleGen', function ($genQuery) use ($search) {
                        $genQuery->where('name', 'ILIKE', $search);
                    });
            });
        }

        $vehicles = $query->with([

            'brand',
            'model',
            'vehicleType',
            'fuelType',
            'transmissionType',
            'city',
            'currency',
            'primaryImage',

        ])->paginate(20);

        $matchingVehicles=$vehicles->total();
        $totalVehicles=Vehicle::where('status','active')->count();

        return response()->json([
            'vehicles' => $vehicles,
            'matchingVehicles'=>$matchingVehicles,
            'totalVehicles'=>$totalVehicles
        ], 200);
    }

    public function show(Vehicle $vehicle)
    {
        if ($vehicle->status !== 'active') {
            return response()->json([
                'message' => 'Vehicle not found',
            ], 404);
        }

        $vehicle->load([
            'brand',
            'model',
            'vehicleType',
            'vehicleGen',
            'fuelType',
            'transmissionType',
            'driveTrainType',
            'bodyType',
            'engineLayout',
            'engineCyl',
            'aspirationType',
            'condition',
            'color',
            'currency',
            'country',
            'city',
            'images',
            'features',
        ]);

        return response()->json([
            'vehicle' => $vehicle
        ]);
    }

    public function store(StoreVehicleRequest $request)
    {
        $vehicleData = $request->validated();

        $vehicleData['user_id'] = $request->user()->id;

        $vehicle = Vehicle::create($vehicleData);

        return response()->json([
            'message' => 'vehicle added successfully!',
            'vehicle' => $vehicle
        ], 201);
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {

        if ($vehicle->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        }

        $vehicleData = $request->validated();


        $vehicle->update($vehicleData);

        return response()->json([
            'message' => 'vehicle updated successfully!',
            'vehicle' => $vehicle,
        ], 200);
    }

    public function destroy(Vehicle $vehicle, Request $request)
    {
        if ($vehicle->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }
        foreach ($vehicle->images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        Storage::disk('public')->deleteDirectory(
            'vehicles/' . $vehicle->id
        );

        $vehicle->delete();

        return response()->json([
            'message' => 'vehicle deleted successfully'
        ]);
    }
}
