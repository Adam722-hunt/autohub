<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'brand_id' => 'required|exists:brands,id',
            'model_id' => 'required|exists:vehicle_models,id',
            'vehicle_generation_id' => 'nullable|exists:vehicle_generations,id',

            'year' => 'required|integer',

            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',

            'fuel_type_id' => 'required|exists:fuel_types,id',
            'transmission_id' => 'required|exists:transmissions,id',
            'drivetrain_id' => 'required|exists:drivetrains,id',
            'body_type_id' => 'required|exists:body_types,id',

            'engine_displacement' => 'nullable|integer',
            'aspiration_id' => 'nullable|exists:aspirations,id',
            'engine_layout_id' => 'nullable|exists:engine_layouts,id',
            'engine_cylinder_id' => 'nullable|exists:engine_cylinders,id',

            'mileage' => 'required|integer|min:0',
            'condition_id' => 'required|exists:conditions,id',
            'color_id' => 'required|exists:colors,id',

            'title' => 'required|string|max:255',
            'description' => 'required|string',

            'price' => 'required|decimal:0,2',
            'currency_id' => 'required|exists:currencies,id',

            'horsepower' => 'nullable|integer',
            'torque' => 'nullable|integer',

            'negotiable' => 'required|boolean',
        ];
    }
}
