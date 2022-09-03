<?php

namespace App\Http\Resources;

use App\Models\DictionaryUpload;
use App\Models\LangFlag;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        try{
            $dicUpload      =   DictionaryUpload::where('language_id',$this->id)
                ->orderBy('id','DESC')
                ->first();
            $lang_1     =   LangFlag::find($this->lang_1);
            $lang_2     =   LangFlag::find($this->lang_2);
            return [
                'languageId'        =>  $this->id,
                'languageFrom'      =>  $lang_1->lang_name,
                'languageTo'        =>  $lang_2->lang_name,
                'languageFromUrl'   =>  url($lang_1->image_url),
                'languageToUrl'     =>  url($lang_2->image_url),
            ];
        }
        catch(\Exception $ex){
            return [];
        }
    }
}
