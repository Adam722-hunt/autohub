<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCurrencyRequest extends FormRequest
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
            'code' => [
                'required',
                'string',
                'max:3',
                Rule::unique('currencies', 'code'),
            ],

            'name' => [
                'required',
                'string',
                Rule::unique('currencies', 'name'),
            ],

            'symbol' => [
                'required',
                'string',
                'max:10',
            ],
        ];
    }
}