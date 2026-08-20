<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Message;
class Conversation extends Model
{
    protected $fillable=[
        'seller_id','buyer_id','vehicle_id','buyer_deleted_at','seller_deleted_at'
    ];

    public function seller(){
        return $this->belongsTo(User::class,'seller_id');
    }
    public function buyer(){
        return $this->belongsTo(User::class,'buyer_id');
    }

    public function vehicle (){
        return $this->belongsTo(Vehicle::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function latestMessage(){
        return $this->hasOne(Message::class)->latestOfMany();
    }

}
