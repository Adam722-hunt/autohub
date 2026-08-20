<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquenModel;
use App\Models\Brand;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use App\Models\VehicleGen;
use App\Models\FuelType;
use App\Models\TransmissionType;
use App\Models\DriveTrainType;
use App\Models\BodyType;
use App\Models\EngineLayout;
use App\Models\EngineCyl;
use App\Models\AspirationType;
use App\Models\VehicleCondition;
use App\Models\VehicleColor;
use App\Models\Currency;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\VehicleImage;
use App\Models\Feature;
use App\Models\Report;

class Vehicle extends EloquenModel
{
    protected $fillable = [
        'vehicle_type_id',
        'brand_id',
        'model_id',
        'vehicle_generation_id',
        'year',
        'fuel_type_id',
        'transmission_id',
        'drivetrain_id',
        'body_type_id',
        'engine_displacement',
        'engine_layout_id',
        'engine_cylinder_id',
        'aspiration_id',
        'condition_id',
        'color_id',
        'mileage',
        'horsepower',
        'title',
        'description',
        'torque',
        'negotiable',
        'status',
        'price',
        'user_id',
        'country_id',
        'city_id',
        'currency_id'
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'engine_displacement' => 'integer',
            'mileage' => 'integer',
            'horsepower' => 'integer',
            'torque' => 'integer',

            'price' => 'decimal:2',

            'negotiable' => 'boolean',

            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    public function vehicleGen()
    {
        return $this->belongsTo(VehicleGen::class ,'vehicle_generation_id');
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }

    public function transmissionType()
    {
        return $this->belongsTo(TransmissionType::class, 'transmission_id');
    }

    public function driveTrainType()
    {
        return $this->belongsTo(DriveTrainType::class, 'drivetrain_id');
    }

    public function bodyType()
    {
        return $this->belongsTo(BodyType::class);
    }

    public function engineLayout()
    {
        return $this->belongsTo(EngineLayout::class);
    }

    public function engineCyl()
    {
        return $this->belongsTo(EngineCyl::class,'engine_cylinder_id');
    }

    public function aspirationType()
    {
        return $this->belongsTo(AspirationType::class,'aspiration_id');
    }

    public function condition()
    {
        return $this->belongsTo(VehicleCondition::class);
    }

    public function color()
    {
        return $this->belongsTo(VehicleColor::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(VehicleImage::class)->where('is_primary', 'true');
    }

    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class,'vehicle_feature');
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
