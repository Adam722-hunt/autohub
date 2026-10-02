<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
class VehicleCondition extends Model
{
    protected $table='conditions';
    protected $fillable=[
        'name'
    ];


    public function vehicles(){
        return $this->hasMany(Vehicle::class,'condition_id');
    }
}
