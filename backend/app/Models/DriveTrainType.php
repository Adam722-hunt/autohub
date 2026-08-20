<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
class DriveTrainType extends Model
{

    protected $table = 'drivetrains';
    protected $fillable=[
        'name'
    ];
    
    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }
}
