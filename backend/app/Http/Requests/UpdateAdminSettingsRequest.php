<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminSettingsRequest extends FormRequest
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
            'site_name' => 'required|string|max:255',
            'max_photos_per_listing' => 'required|integer|min:1',
            'verify_user' => 'required|boolean',
            'notify_new_user_registration' => 'required|boolean',
            'notify_new_report_submitted' => 'required|boolean',
            'notify_new_listing_created' => 'required|boolean',
            'auto_approve_listings' => 'required|boolean',
            'enable_messaging' => 'required|boolean',

        ];
    }
}
