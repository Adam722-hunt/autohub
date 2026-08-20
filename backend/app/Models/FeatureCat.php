<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Feature;
class FeatureCat extends Model
{

    protected $table = 'feature_categories';
    
    protected $fillable=[
            'name'
    ];

    public function features(){
        return $this->hasMany(Feature::class);
    }
}
