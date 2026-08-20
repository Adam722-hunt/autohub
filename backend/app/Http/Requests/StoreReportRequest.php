<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

   public function rules(): array
{
    return [
        'reason' => 'required|in:fraud,incorrect_information,inappropriate_content,duplicate_listing,vehicle_not_available,other',
        'reason_description' => 'required_if:reason,other|nullable|string',
        'evidence' => 'nullable|file',
    ];
}
}