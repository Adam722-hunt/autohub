<?php

namespace App\Http\Resources;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
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
            'seller_id' => $this->seller_id,
            'buyer_id' => $this->buyer_id,
            'vehicle_id' => $this->vehicle_id,

            'messages' => MessageResource::collection($this->messages),

            'vehicle' => $this->vehicle,
            'seller' => $this->seller,
            'buyer' => $this->buyer,
        ];
    }
}
