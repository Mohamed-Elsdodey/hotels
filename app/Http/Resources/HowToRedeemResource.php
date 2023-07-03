<?php

namespace App\Http\Resources;

use App\Models\Governorate;
use Illuminate\Http\Resources\Json\JsonResource;

class HowToRedeemResource extends JsonResource
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
            'level'=>new LevelResource($this->whenLoaded('level')),
            'client'=>new ClientResource($this->whenLoaded('client')),
            'type'=>new TypeResource($this->whenLoaded('type')),
            'governorate'=>new GovernorateResource($this->whenLoaded('governorate')),

        ];
    }
}
