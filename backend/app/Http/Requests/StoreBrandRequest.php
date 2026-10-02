<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'name'=>'required|string|min:2|unique:brands,name',
            'vehicle_type_id'=>'required|exists:vehicle_types,id',
            'logo'=>'image|mimes:jpg,jpeg,png,webp|max:5120|nullable|unique:brands,logo'
        ];
    }
}
