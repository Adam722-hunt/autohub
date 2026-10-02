<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserNotificationSetting extends Model
{
    protected $fillable = [
        'user_id',
        'messages',
        'reports',
        'listings',
        'favorites',
        'matching_listings',
        'reviews'
    ];


    protected  function casts(): array
    {
        return [
            'messages'=>'boolean',
            'reports'=>'boolean',
            'listings'=>'boolean',    
            'favorites'=>'boolean',    
            'matching_listings'=>'boolean',    
            'reviews'=>'boolean',
        ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
