<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Question extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'content'=>$this->content,
            'option_a'=>$this->option_a,
            'option_b'=>$this->option_b,
            'option_c'=>$this->option_c,
            'option_d'=>$this->option_d,
            'correct_answer'=>$this->correct_answer,
            'mark'=> $this->mark,
            'id'=> $this->id,

        ];
    }

    
}
