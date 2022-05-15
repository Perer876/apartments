<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BuildingResource extends JsonResource
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
            'alias' => $this->alias,
            'address' => [
                'street' => $this->street,
                'number' => $this->number,
            ],
            'location' => [
                'city' => $this->city,
                'state' => $this->state,
                'postcode' => $this->postcode,
            ],
            'builded_at' => $this->builded_at,
        ];
    }
}
