<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class resourcepooses extends JsonResource
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
        'name'=>$this->name,
        'statr_tear'=>$this->statr_tear,
        'image'=>$this->image
        ];
        
    }
}
