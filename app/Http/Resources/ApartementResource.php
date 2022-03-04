<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApartementResource extends JsonResource
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
            'id'            =>$this->id,
            'approved'      =>$this->approved,
            'description'   =>$this->description,
            'address'       =>$this->address,
            'price'         =>$this->price,
            'link'          =>$this->link,
            'gender'        =>$this->gender,
            'images'        =>$this->images,
            'available'     =>$this->available,
            'max'           =>$this->max,
            'nearby'        =>$this->nearby,
            'owner_id'      =>$this->owner_id,
            'created_at'    =>$this->created_at
        ];
    }
}
