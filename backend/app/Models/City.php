<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Country;
class City extends Model
{
    protected $fillable=[
        'country_id','name'
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }
}
