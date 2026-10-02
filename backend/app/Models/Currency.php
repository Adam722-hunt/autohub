<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
class Currency extends Model
{
    protected $fillable=[
        'code','name','symbol'
    ];

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }

    public function preferences(){
        return $this->hasMany(UserPreference::class);
    }
}
