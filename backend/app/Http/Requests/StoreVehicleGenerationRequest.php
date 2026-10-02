<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVehicleGenerationRequest extends FormRequest
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
            'model_id' => 'required|exists:vehicle_models,id',

            'name' => [
                'required',
                'string',
                Rule::unique('vehicle_generations', 'name')
                    ->where('model_id', $this->model_id),
            ],

            'from' => 'required|integer|min:1886|max:2100',
            'to' => 'nullable|integer|min:1886|max:2100',
        ];
    }
    public function messages(): array
    {
        return [
            'name.unique' => 'This generation already exists for this model.',
        ];
    }
}
