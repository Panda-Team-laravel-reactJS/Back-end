<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "image" => $this->image,
            "description" =>$this->description,
            "price" =>$this ->price,
            "isDisplayed" =>$this->isDisplayed,
            "category_id" =>$this ->category_id,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at

        ];

        //return parent::toArray($request);
    }
}
