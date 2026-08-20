<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

use App\Models\VehicleModel;
use App\Models\Vehicle;
use App\Models\VehicleType;
class Brand extends EloquentModel
{
    protected $fillable=[
        'name','vehicle_type_id'
    ];

    public function vehicleModels(){
        return $this->hasMany(VehicleModel::class);
    }

    public function vehicles (){
        return $this->hasMany(Vehicle::class);
    }

    public function vehicleType(){
        return $this->belongsTo(VehicleTYpe::class);
    }
}
