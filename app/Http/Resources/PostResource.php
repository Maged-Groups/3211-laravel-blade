<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Post Number' => $this->id,
            'Header' => $this->post_title,
            'Content' => $this->post_title,
            'Thumbnail' => $this->thumbnail,
            'Posted on' => $this->created_at,
            "Posted by" => UserResource::make($this->whenLoaded('user')),
         ];
    }
}
