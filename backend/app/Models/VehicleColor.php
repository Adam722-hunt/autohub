<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
class VehicleColor extends Model
{
    protected $table='colors';
    protected $fillable=[
        'name'
    ];

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }
}
