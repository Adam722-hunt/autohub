<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBrandRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:2',
                Rule::unique('brands', 'name')->ignore($this->brand),
            ],
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'logo' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
                'nullable',
                Rule::unique('brands', 'logo')->ignore($this->brand),
            ]

        ];
    }
}
