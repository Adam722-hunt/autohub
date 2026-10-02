<?php

namespace App\Http\Controllers;

use App\Models\AdminSetting;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAdminSettingsRequest;

class AdminSettingsController extends Controller
{
    public function get()
    {
        $settings = AdminSetting::select(['key', 'value'])->get();
        return response()->json([
            'settings' => $settings
        ], 200);
    }

    public function update(UpdateAdminSettingsRequest $request)
    {
        $booleanSettings = [
            'enable_messaging',
            'auto_approve_listings',
            'verified_seller_badge',
            'notify_new_user_registration',
            'notify_new_report_submitted',
            'notify_new_listing_created',
        ];

        $settings = $request->validated();
        foreach ($settings as $key => $value) {
            if (in_array($key, $booleanSettings)) {
                $value = $value ? 'true' : 'false';
            }
            AdminSetting::where('key', $key)->update(['value' => $value]);
        }
        return response()->json([
            'message' => 'Settings saved'
        ], 200);
    }
}
