<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Vehicle;

class SavedSearch extends Model
{
    protected $fillable = [
        'user_id',
        'filters',
        'name'
    ];

    protected $casts = [
        'filters' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function matchesVehicle(Vehicle $vehicle)
    {
        $filters = $this->filters;

        if (isset($filters['brand_id']) && $vehicle->brand_id != $filters['brand_id']) {
            return false;
        }

        if (isset($filters['model_id']) && $vehicle->model_id != $filters['model_id']) {
            return false;
        }

        if (isset($filters['vehicle_type_id']) && $vehicle->vehicle_type_id != $filters['vehicle_type_id']) {
            return false;
        }

        if (isset($filters['body_type_id']) && $vehicle->body_type_id != $filters['body_type_id']) {
            return false;
        }
        if (isset($filters['min_price']) && $vehicle->price < $filters['min_price']) {
            return false;
        }

        if (isset($filters['max_price']) && $vehicle->price > $filters['max_price']) {
            return false;
        }
        if (isset($filters['condition_id']) && $vehicle->condition_id != $filters['condition_id']) {
            return false;
        }
        if (isset($filters['transmission_id']) && $vehicle->transmission_id != $filters['transmission_id']) {
            return false;
        }
        if (isset($filters['drivetrain_id']) && $vehicle->drivetrain_id != $filters['drivetrain_id']) {
            return false;
        }
        if (isset($filters['fuel_type_id']) && $vehicle->fuel_type_id != $filters['fuel_type_id']) {
            return false;
        }
        if (isset($filters['engine_cylinder_id']) && $vehicle->engine_cylinder_id != $filters['engine_cylinder_id']) {
            return false;
        }
        if (isset($filters['aspiration_id']) && $vehicle->aspiration_id != $filters['aspiration_id']) {
            return false;
        }
        if (isset($filters['engine_layout_id']) && $vehicle->engine_layout_id != $filters['engine_layout_id']) {
            return false;
        }
        if (isset($filters['country_id']) && $vehicle->country_id != $filters['country_id']) {
            return false;
        }
        if (isset($filters['city_id']) && $vehicle->city_id != $filters['city_id']) {
            return false;
        }
        if (isset($filters['min_engine_displacement']) && $vehicle->engine_displacement < $filters['min_engine_displacement']) {
            return false;
        }
        if (isset($filters['max_engine_displacement']) && $vehicle->engine_displacement > $filters['max_engine_displacement']) {
            return false;
        }
        if (isset($filters['min_mileage']) && $vehicle->mileage < $filters['min_mileage']) {
            return false;
        }
        if (isset($filters['max_mileage']) && $vehicle->mileage > $filters['max_mileage']) {
            return false;
        }
        if (isset($filters['min_year']) && $vehicle->year < $filters['min_year']) {
            return false;
        }
        if (isset($filters['max_year']) && $vehicle->year > $filters['max_year']) {
            return false;
        }


        return true;
    }
}
