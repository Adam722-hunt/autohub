<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
class AspirationType extends Model
{
    protected $table="aspirations";
    protected $fillable=[
            'name'
    ];

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }
}
