<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageJsonResource extends JsonResource
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
            'id'                =>  $this->id,
            'languageId'        =>  $this->language_id,
            'dictionary_url'    =>  !empty($this->json_file)?url($this->json_file):'',
            'versions'          =>  'V'.$this->versions
        ];
    }
}
