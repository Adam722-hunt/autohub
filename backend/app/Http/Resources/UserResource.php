<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $request->user('sanctum')?->id === $this->id
                ? $this->phone
                : ($this->show_phone === true
                    ? $this->phone
                    : null),
            'avatar' => $this->avatar,
            'cover_image' => $this->cover_image,
            'bio' => $this->bio,
            'phone_verified' => $this->phone_verified,
            // 'role' => $this->role,
            // 'status' => $this->status,
            'country' => $this->country,
            'city' => $this->city,
            'created_at' => $this->created_at,

            'rating' => $this->receivedReviews->avg('rating'),
            'reviews_count' => $this->receivedReviews->count(),
            'reviews' => ReviewResource::collection($this->receivedReviews),
        ];
    }
}
