<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\City;
class Country extends Model
{
    protected $fillable=[
            'name'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }

    public function cities(){
        return $this->hasMany(City::class);
    }
}
