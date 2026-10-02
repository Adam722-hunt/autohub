<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'first_name' => 'sometimes|string|max:20',
            'last_name' => 'sometimes|string|max:20',

            'username' => 'sometimes|required|string|max:20|unique:users,username,' . $this->user()->id,

            'email' => 'sometimes|required|email|unique:users,email,' . $this->user()->id,

            'phone' => 'sometimes|required|string|max:13|unique:users,phone,' . $this->user()->id,

            'country_id' => 'sometimes|nullable|exists:countries,id',

            'city_id' => 'sometimes|nullable|exists:cities,id',

            'bio' => 'sometimes|nullable|string|max:1000',

            'avatar'=>'sometimes|nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cover_image'=>'sometimes|nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ];
    }
}
