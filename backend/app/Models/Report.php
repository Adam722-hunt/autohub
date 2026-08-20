<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Vehicle;
class Report extends Model
{
    protected $fillable=[
            'user_id','vehicle_id','reason','reason_description','evidence','status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function vehicle(){
        return  $this->belongsTo(Vehicle::class);
    }
}
