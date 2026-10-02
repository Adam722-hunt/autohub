<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
class EngineCyl extends Model
{
  protected $table='engine_cylinders';

    protected $fillable=[
            'name'
    ];

      public function vehicles(){
        return $this->hasMany(Vehicle::class,'engine_cylinder_id');
    }
    
}
