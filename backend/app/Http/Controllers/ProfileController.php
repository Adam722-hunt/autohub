<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user()->load([
            'country',
            'city',
            'receivedReviews.reviewer',
        ]);
        return response()->json([
            'user' => new UserResource($user)
        ]);
    }

    public function publicProfile(User $user)
    {
        $user->load([
            'country',
            'city',
            'receivedReviews.reviewer',
        ]);
        return response()->json([
            'user' => new UserResource($user)
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();

        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->hasFile('cover_image')) {
            if ($user->cover_image) {
                Storage::disk('public')->delete($user->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $user->update($data);

        return response()->json([
            'message' => 'Profile updated successfully!',
            'user' => new UserResource($user->fresh())
        ]);
    }
}
