<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            "email" => $this->email,
            "phoneNumber" =>$this->phone_number,
            "address" =>$this ->address,
            "gender" =>$this->gender,
            "dob" =>$this ->dob,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at

        ];
    }
}
