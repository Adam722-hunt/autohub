<?php

namespace App\Models;
use App\Models\Brand;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    protected $fillable = [
        'brand_id',
        'name',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function vehicles(){
        return $this->hasMany(Vehicle::class,'model_id');
    }
}