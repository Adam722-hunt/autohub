<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'reviewer_id' => $this->reviewer_id,
            'reviewed_user_id' => $this->reviewed_user_id,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'created_at'=>$this->created_at,

            'reviewer' => [
                'id' => $this->reviewer->id,
                'username' => $this->reviewer->username,
                'first_name' => $this->reviewer->first_name,
                'last_name' => $this->reviewer->last_name,
                'avatar' => $this->reviewer->avatar,
            ],
        ];
    }
}