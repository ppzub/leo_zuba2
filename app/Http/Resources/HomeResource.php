<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => mb_substr($this->content, 0, 1000) . '...',
            'image' => $this->getImage()->medium,
            'author' => $this->user->name,
            'date' => $this->getDate(),
            'user_like_count' => $this->userLike->count()
        ];
    }
}
