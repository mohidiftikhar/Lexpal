<?php

namespace App\Repositories\language;

use App\Models\LangFlag;
use App\Models\Language;
use App\Repositories\BaseRepository;

class LanguageRepository extends BaseRepository implements LanguageInterface
{
    protected $model;
    protected $_LangFlag;
    public function __construct(Language $model,LangFlag $_LangFlag)
    {
        $this->model = $model;
        $this->_LangFlag = $_LangFlag;
        parent::__construct($model);
    }
    public function getAllLanguages():array{
        $languages      =   $this->model::where('is_active',1)
            ->get();
        //dd($languages);
        $data           =   [];
        foreach ($languages as  $language){
            //dd($language);

            $lang_1     =   $this->_LangFlag::find($language->lang_1);
            $lang_2     =   $this->_LangFlag::find($language->lang_2);
            $newKey     =   0;
            $data[]     =   [
                'slug'              =>  strtolower($lang_1->lang_name."_".$lang_2->lang_name),
                'newKey'            =>  (int)$newKey,
                'languageId'        =>  $language->id,
                'languageFrom'      =>  $lang_1->lang_name,
                'languageTo'        =>  $lang_2->lang_name,
                'languageFromUrl'   =>  url($lang_1->image_url),
                'languageToUrl'     =>  url($lang_2->image_url),
            ];
            $newKey++;
            $data[]     =   [
                'slug'              =>  strtolower($lang_2->lang_name."_".$lang_1->lang_name),
                'newKey'            =>  (int)$newKey,
                'languageId'        =>  $language->id,
                'languageFrom'      =>  $lang_2->lang_name,
                'languageTo'        =>  $lang_1->lang_name,
                'languageFromUrl'   =>  url($lang_2->image_url),
                'languageToUrl'     =>  url($lang_1->image_url),
            ];
        }
        return $data;
    }

    public function searchDictionary(array $request)
    {
        $languageType           =   (int)$request['languageType'];
        $languageId             =   (int)$request['languageId'];
        $search                 =   $request['search'] ?? "";
        $entryword              =   ($languageType ===0)?'inflactedform':'inflactedform_1';
        $inflactedform              =   ($languageType ===0)?'inflactedform':'inflactedform_1';
        $request['page']        =   !empty($request['page'])?$request['page']:1;
        $dictionaries           =    ('App\Models\Dictionary_'.$languageId)::

            where(function ($query) use ($search,$entryword,$request) {
                if (isset($request['search']) && $request['search'] != "") {
                    $query->distinct('ids');
                    $query->where($entryword,'like',$search."%");

                }
                if (isset($request['ids']) && $request['ids'] != "") {
                    $query->where('ids','=',$request['ids']);
                }
            })

            ->orderByRaw('CHAR_LENGTH('.$entryword.') ASC')
            ->orderBy($entryword,'ASC')
            ->paginate(20);
//        dd($dictionaries);
        return $dictionaries;
    }
}
