<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
use App\Models\VehicleModel;
class VehicleGen extends Model
{
    protected $table='vehicle_generations';
    
    protected $fillable=[
        'model_id','name','from','to'
    ];

    public function vehicles(){
        return $this->hasMany(Vehicle::class,'vehicle_generation_id');
    }

    public function vehicleModel(){
        return $this->belongsTo(VehicleModel::class,'model_id');
    }

}
