<?php

namespace App\Http\Controllers\API;

use App\DataTables\LanguagesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageJsonRequest;
use App\Http\Requests\SocialRequest;
use App\Http\Resources\DictionaryResource;
use App\Http\Resources\LanguageJsonResource;
use App\Http\Resources\LanguageResource;
use App\Models\DictionaryUpload;
use App\Models\LangFlag;
use App\Models\Language;
use App\Repositories\guest\GuestRepository;
use App\Repositories\language\LanguageInterface;
use App\Repositories\license\LicenseInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class ApiController extends Controller
{
    protected $LanguageRepository;
    protected $licenseRepository;
    public function __construct(LanguageInterface $LanguageRepository,LicenseInterface $licenseRepository){
        $this->LanguageRepository = $LanguageRepository;
        $this->licenseRepository = $licenseRepository;
    }
    public function getLanguages(Request $request){
        if (!empty($request['language'])){
            try {
                $language       =   explode('_',$request['language']);
                $lang_1     =   LangFlag::where("lang_name",$language[0])->first();
                $lang_2     =   LangFlag::where('lang_name',$language[1])->first();
                $languages      =   Language::where('is_active',1)
                    ->where('lang_1',$lang_1->id??0)
                    ->where('lang_2',$lang_2->id??0)
                    ->first();
                return  response()->json([
                    'success'           =>  true,
                    'message'           =>  'success',
                    'data'              => new LanguageResource($languages)
                ],200);
            }
            catch (\Exception $exception){
                return  response()->json([
                    'success'           =>  false,
                    'message'           =>  $exception->getMessage(),
                    'data'              => []
                ],200);
            }
        }
        return  response()->json([
            'success'           =>  false,
            'message'           =>  'success',
            'data'              => new \stdClass()
        ],200);
    }

    public function getLanguagesJson(LanguageJsonRequest $request){
        $languageId            =   $request['languageId'];
        $currentVersion        =   $request['version'];
        $currentVersionId      =   str_replace('V','',$currentVersion);
        $dicUpload             =   DictionaryUpload::where('language_id',$languageId)
            ->where('is_json_completed',1)
            ->where('is_current',1)
            ->orderBy('id','DESC')
            ->first();
        if ($dicUpload){
            if ($dicUpload->json_file === null){
                return response()->json([
                    'success'       =>  true,
                    'message'       =>  'Dictionary upload are in progress',
                    'type'          =>  'in_progress',
                    'data'          =>  new \stdClass()
                ],200);
            }
            if ($dicUpload->versions ===$currentVersionId){
                return response()->json([
                    'success'       =>  true,
                    'message'       =>  'Dictionary are already upto date',
                    'type'          =>  'upto_date'
                ],200);
            }
            else{
                return response()->json([
                    'success'       =>  true,
                    'message'       =>  'Dictionary are already not upto date',
                    'type'          =>  'out_of_date',
                    'data'          =>  new LanguageJsonResource($dicUpload)
                ],200);
            }
        }
        return response()->json([
            'success'       =>  true,
            'type'          =>  'in_progress',
            'message'       =>  'Dictionary is not valid or Dictionary upload are in progress'
        ],200);
    }

    public function searchDictionary(Request $request){
        $request->validate([
            'languageType'      =>  'required',
            'languageId'        =>  'required|numeric',
            'search'            =>  'required',
            'page'              =>  'required|numeric'
        ]);
        $languageType           =   (int)$request['languageType'];
        $entryword              =   ($languageType ===0)?'inflactedform':'inflactedform_1';
        $dictionaries           =    $this->LanguageRepository->searchDictionary($request->all());
        return response()->json([
            'success'       =>  true,
            'message'       =>  'search results '.$entryword,
            'languageType'  =>  $languageType,
            'pagination'    =>  [
                'currentPage'       =>  $dictionaries->currentPage(),
                'nextPage'          =>  (int)($dictionaries->currentPage()+1)
            ],
            'data'          =>  DictionaryResource::collection($dictionaries->items())
        ]);
    }

    public function searchDictionaryIds(Request $request,$ids){
        $request->validate([
            'languageId'        =>  'required|numeric',
        ]);
        $search                 =   $ids;

        $languageId             =   $request['languageId'];
        $languageType           =   (int)$request['languageType'];
        $entryword              =   ($languageType ===0)?'inflactedform':'inflactedform_1';
        $dictionaries           =   ('App\Models\Dictionary_'.$languageId)::where('ids','=',$search)
            ->orderByRaw('CHAR_LENGTH('.$entryword.') ASC')
            ->orderBy($entryword,'ASC')
            ->paginate(100);
        return response()->json([
            'success'   =>  true,
            'message'   =>  'search results',
            'languageType'  =>  $languageType,
            'data'      =>  DictionaryResource::collection($dictionaries->items())
        ]);
    }

    public function getAllLanguages(Request $request){
        $data = $this->LanguageRepository->getAllLanguages();
        return response()->json([
            'success'       =>  true,
            'messages'      =>  'languages loaded',
            'data'          =>  $data
        ],200);
    }
    public function checkLicenses(SocialRequest $request){
        $email =$request['email'];
        $domain_name = substr(strrchr($email, "@"), 1);
        $check = $this->licenseRepository->checkLicense($request['driver'],$domain_name,$request['product_type']);
        if($check){
            return response()->json([
                'success'       =>  true,
                'messages'      =>  'License Found',
            ],200);
        }
        else{
            return response()->json([
                'success'       =>  false,
                'messages'      =>  'License Not Found',
            ],200);
        }
    }
}
