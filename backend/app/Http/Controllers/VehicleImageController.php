<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class VehicleImageController extends Controller
{
    public function store(Request $request, Vehicle $vehicle)
    {
        if($vehicle->user_id!==$request->user()->id){
            return response()->json([
                'message'=>'Unauthorized',
            ],403);
        }

        $request->validate([
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);
        $has_primary=$vehicle->images()->where('is_primary',true)->exists();

        $last_index=$vehicle->images()->max('default_order')??0;

        foreach ($request->file('images') as $index=> $image) {
            $path = $image->store('vehicles/' . $vehicle->id, 'public');
            $vehicle->images()->create([
                'image' => $path,
                'is_primary'=>!$has_primary&&$index===0,
                'default_order'=>$last_index + $index +1,   
            ]);
        }
        return response()->json([
            'message'=>'images uploaded successfully',
            'images'=>$vehicle->images,
        ],201);
    }

    public function delete(Vehicle $vehicle , VehicleImage $image, Request $request){

        if ($vehicle->user_id!==$request->user()->id){
            return response()->json([
                'message'=>'Unauthorized',
            ],403);
        }

        if ($image->vehicle_id!==$vehicle->id){
            return response()->json([
                'message'=>'Image does not belong to this vehicle',
            ],404);
        }

        $is_primary=$image->is_primary;

        Storage::disk('public')->delete($image->image);
        $image->delete();   

        if($is_primary){
            $next_image=$vehicle->images()->orderBy('default_order')->first();

            if($next_image){
                $next_image->update([
                    'is_primary'=>true
                ]);
            }
        }
        
        return response()->json([
            'message'=>'Image deleted successfully',
        ],200);
    }
}
    