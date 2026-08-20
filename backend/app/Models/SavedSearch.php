<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class SavedSearch extends Model
{
    protected $fillable=[
        'user_id','filters','name'
    ];

    protected $casts=[
        'filters'=>'array'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
