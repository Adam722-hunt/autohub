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
        $other_user = $request->user()->id == $this->seller_id ? $this->buyer : $this->seller;
        return [
            'id' => $this->id,
           
            'latest_message' => $this->latestMessage,
            'vehicle' => $this->vehicle,

            'other_user' => [
                'username' => $other_user->username,
                'avatar' => $other_user->avatar,
            ],
            
            'unread_messages_count'=>$this->unread_messages_count,

            'messages'=>MessageResource::collection($this->whenLoaded('messages'))
        ];
    }
}
