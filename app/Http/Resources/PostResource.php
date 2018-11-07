<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'content' => $this->content,
            'image' => $this->getImage()->medium,
            'video' => 'https://www.youtube.com/embed/' . $this->video,
            'author' => $this->user->name,
            'date' => $this->getDate(),
            'likes_count'=> $this->likes->count(),
            'user_like_count' => $this->userLike->count()
        ];
    }
}
