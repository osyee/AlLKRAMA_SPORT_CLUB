<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class resourcestanding extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'win'=>$this->win,
            'lose'=>$this->lose,
            'draw'=>$this->draw,
            '+/-'=>$this->{'+/-'},
            'point'=>$this->point,
            'play'=>$this->play,
            'Clubs_id '=>$this->club->name,
            'sessions_id '=>$this->session->name,





        ];
    }
}
