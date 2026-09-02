<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Userapi extends JsonResource
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
            'id' => $this->id,
            'usertype' => $this->usertype,
            'name' => $this->name,
            'email' => $this->email,
            'password' => null,
            'contact_no' => $this->contact_no,
            'address' => $this->address,
            'shopingcenter_id ' => $this->shopingcenter_id ,
            'is_created ' => $this->is_created ,
            'is_deleted ' => $this->is_deleted ,
            'can_add ' => $this->can_add ,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
