<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
class TransmissionType extends Model
{
    protected $table='transmissions';
    protected $fillable=[
        'name'
    ];

    public function vehicles(){
        return $this->hasMany(Vehicle::class,'transmission_id');
    }
}
