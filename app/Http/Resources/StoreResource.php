<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'id'=>(int)$this->id,
            'name'=>$this->getTranslation('name', session_lang()),
            'desc'=>$this->getTranslation('desc', session_lang()),
            'photo'=>get_file($this->photo),

        ];
    }
}
