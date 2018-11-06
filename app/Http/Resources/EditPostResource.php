<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EditPostResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->image,
            'image_src' => $this->getImage()->small,
            'video_embed' => 'https://www.youtube.com/embed/' . $this->video,
            'video' => $this->video
        ];
    }
}
