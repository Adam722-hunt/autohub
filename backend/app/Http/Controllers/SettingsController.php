<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreChangePasswordRequest;
use App\Http\Requests\UpdatePreferencesRequest;
use App\Http\Requests\UpdatePhoneVisibilityRequest;
use App\Http\Requests\UpdateNotificationSettingsRequest;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function changePassword(StoreChangePasswordRequest $request)
    {
        $data = $request->validated();

        $new_password = Hash::make($data['new_password']);

        $request->user()->update(
            [

                'password' => $new_password
            ]
        );

        return response()->json([
            'message' => 'password updated successfully'
        ], 200);
    }

    public function getPreferences(Request $request)
    {
        $user_preferences = $request->user()->preference()->with('currency:id,name,code,symbol')->first();
        return response()->json([
            'preferences' => $user_preferences
        ], 200);
    }

    public function updatePreferences(UpdatePreferencesRequest $request)
    {

        $data = $request->validated();

        $new_currency = $data['currency_id'];
        $new_distance_unit = $data['distance_unit'];

        $request->user()->preference()->update([
            'currency_id'  => $new_currency,
            'distance_unit'  => $new_distance_unit

        ]);

        return response()->json([
            'message' => 'modifications updated successfully'
        ], 200);
    }

    public function togglePhoneNumberVisibility(UpdatePhoneVisibilityRequest $request)
    {
        $data = $request->validated();
        $request->user()->update([
            'show_phone' => $data['show_phone']
        ]);
        return response()->json([
            'message' => 'modification updated successfully'
        ]);
    }

    public function deleteAccount(Request $request)
    {
        $token = $request->user()->currentAccessToken();
        $token->delete();
        $request->user()->delete();
        return response()->json([
            'message' => 'account deleted successfully'
        ]);
    }

    public function getNotificationSettings(Request $request)
    {
        return response()->json([
            'notifications' => $request->user()->notificationSettings
        ], 200);
    }

    public function updateNotificationSettings(UpdateNotificationSettingsRequest $request)
    {
        $data = $request->validated();

        $request->user()->notificationSettings()->update($data);

        return response()->json([
            'message' => 'notification settings updated successfully'
        ], 200);
    }
}
