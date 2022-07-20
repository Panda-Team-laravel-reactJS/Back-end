<?php

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $serviceList = Service::where("category_id", $this->id)->get();
        return [
            "id" => $this->id,
            "name" => $this->name,
            "image" =>$this->image,
            "serviceList" => new ServiceCollection($serviceList )
        ];
    }
}
