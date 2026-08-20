<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Conversation;
class Message extends Model
{
    protected $fillable=[
            'conversation_id','sender_id','message','deleted_at'
    ];

    public function conversation (){
        return $this->belongsTo(Conversation::class);
    }

    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
}
