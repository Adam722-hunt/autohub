<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
use App\Models\Brand;
class VehicleType extends Model
{
    protected $fillable=[
        'name'
    ];

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }

    public function brands(){
        return $this->hasMany(Brand::class);
    }
    
}
