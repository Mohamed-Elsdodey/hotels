<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HowToGetPointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>(int) $this->id,
            'subject'=>$this->getTranslation('subject', session_lang()),
            'content'=>$this->getTranslation('content', session_lang()),
            'brief'=>$this->getTranslation('brief', session_lang()),
            'photo'=>get_file($this->photo),
            'video_url'=>$this->video_url,
            'valid_to'=>$this->valid_to,
            'points'=>(int)$this->points,
            'level'=>new LevelResource($this->whenLoaded('level')),


        ];
    }
}
