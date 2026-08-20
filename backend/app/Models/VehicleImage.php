<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
class VehicleImage extends Model
{
    protected $fillable=[
            'image','vehicle_id','is_primary','default_order'
    ];

    protected function casts():array{
        return [
                'is_primary'=>'boolean',
                'default_order'=>'integer',
        ];
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

}
