<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPostsResource extends JsonResource
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
            'content' => mb_substr($this->content, 0, 300) . '...',
            'image' => $this->getImage()->small,
            'video' => 'https://www.youtube.com/embed/' . $this->video
        ];
    }
}
