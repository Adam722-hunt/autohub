<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
class BodyType extends Model
{
    protected $fillable=[
    'name'
    ];

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }
}
