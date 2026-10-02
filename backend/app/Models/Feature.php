<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FeatureCat;
use App\Models\Vehicle;

class Feature extends Model
{


    protected $fillable = [
        'name',
        'feature_category_id'
    ];

    public function featureCat()
    {
        return $this->belongsTo(FeatureCat::class,'feature_category_id');
    }

    public function vehicles()
    {
        return $this->belongsToMany(
            Vehicle::class,
            'vehicle_feature',
            'feature_id',
            'vehicle_id'
        );
    }
}
