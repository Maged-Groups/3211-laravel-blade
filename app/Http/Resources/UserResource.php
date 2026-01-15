<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'User ID' => $this->id,
            'Name' => $this->name,
            'Email Address' => $this->email,
            'Telephone' => $this->phone,
            'Photo' => $this->profile_photo,
            'Registered At' => $this->created_at,
        ];
    }
}
