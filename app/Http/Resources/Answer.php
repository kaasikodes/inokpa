<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Answer extends JsonResource
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
            'content' => $this->content,
            'id' => $this->id,
            'score' => $this->score
        ];
         

    }

    public function with($request)
    {
        //return parent::toArray($request);
        return [
            'question' => $this->question,
            //'version' => '2.00'
            
        ];
         

    }
}
