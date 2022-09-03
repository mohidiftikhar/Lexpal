<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DictionaryResource extends JsonResource
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
            'ids'               =>  $this->ids,
            'id'               =>  $this->id,
            'entryword'         =>  $this->entryword,
            'inflactedform'     =>  $this->inflactedform,
            'topic'             =>  $this->topic,
            'pos'               =>  $this->pos,
            'pos_1'             =>  $this->pos_1,
            'entryword_1'       =>  $this->entryword_1,
            'inflactedform_1'   =>  $this->inflactedform_1,
            'dn_type'           =>  $this->dn_type,
            'l1_sentence'       =>  $this->l1_sentence,
            'l2_sentence'       =>  $this->l2_sentence,
        ];
    }
}
