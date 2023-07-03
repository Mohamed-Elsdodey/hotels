<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PointResource extends JsonResource
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
            'point'=>(int)$this->point,
            'promo_code'=>$this->promo_code,
            'expired_at'=>$this->expired_at,
            'user'=>new UserResource($this->whenLoaded('user')),
        ];
    }
}
