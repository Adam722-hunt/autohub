<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'year' => $this->year,
            'price' => $this->price,
            'mileage' => $this->mileage,
            'engine_displacement' => $this->engine_displacement,
            'color' => $this->color?->only(['id', 'name']),
            'created_at' => $this->created_at,
            'vehicleType' => $this->vehicleType?->only(['id', 'name']),
            'brand' => $this->brand?->only(['id', 'name']),
            'model' => $this->model?->only(['id', 'name']),
            'vehicleGen' => $this->vehicleGen?->only(['id', 'name']),
            'fuelType' => $this->fuelType?->only(['id', 'name']),
            'transmissionType' => $this->transmissionType?->only(['id', 'name']),
            'driveTrainType' => $this->driveTrainType?->only(['id', 'name']),
            'bodyType' => $this->bodyType?->only(['id', 'name']),
            'engineLayout' => $this->engineLayout?->only(['id', 'name']),
            'engineCyl' => $this->engineCyl?->only(['id', 'name']),
            'aspirationType' => $this->aspirationType?->only(['id', 'name']),
            'condition' => $this->condition?->only(['id', 'name']),
            'currency' => $this->currency?->only(['id', 'name', 'code', 'symbol']),
            'country' => $this->country?->only(['id', 'name']),
            'city' => $this->city?->only(['id', 'name']),
            'images' => $this->images->map(
                function ($image) {
                    return $image?->only(['id', 'image']);
                }
            ),
            'features' => $this->features->map(
                function ($feature) {
                    return $feature?->only(['id', 'name']);
                }
            ),
            'vehicleViews' => $this->vehicleViews->count(),
            'seller' => [
                'id' => $this->user->id,
                'username' => $this->user->username,
                'phone' => $request->user('sanctum')?->id === $this->user_id
                    ? $this->user->phone
                    : ($this->user->show_phone === true
                        ? $this->user->phone
                        : null),
                'joined_at' => $this->user->created_at,
                'rating' => $this->user->receivedReviews->avg('rating'),
                'verified' => $this->user->verified,
            ],
        ];
    }
}
