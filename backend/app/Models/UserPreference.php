<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Currency;

class UserPreference extends Model
{
    protected $fillable = [
        'user_id','currency_id','distance_unit'
    ];

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function currency(){

        return $this->belongsTo(Currency::class);

    }
}
