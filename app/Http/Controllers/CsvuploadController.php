<?php

namespace App\Http\Controllers;

use App\DataTables\CsvDataTable;
use App\DataTables\CSVSplitDataTable;
use App\Models\DictionaryUpload;
use App\Models\Language;
use Illuminate\Http\Request;

class CsvuploadController extends Controller
{
    public function index(CsvDataTable $dataTable){
        $languageId     =   !empty(\request()->get('languageId'))?request()->get('languageId'):'';
        return $dataTable->with('languageId',$languageId)->render('csv.index');
    }
    public function allUploadCsv(CSVSplitDataTable $dataTable,$csv_id){
        return $dataTable->with('csv_id',$csv_id)->render('csv.allUploadCsv');
    }

    public function create(){
        $languages  =   Language::where('is_active',1)->get();
        return view('csv.create',compact('languages'));
    }

    public function store(Request $request){
        $file = $request->file('csv_path');
        $language_id    =   $request['language_id'];
        $destinationPath = public_path().'/uploads';
        $file_name  =   strtotime(date('Y-m-d H:i:s')).".csv";
        $file->move($destinationPath,$file_name);

        $dic_upload     =   DictionaryUpload::where('language_id',$language_id)
            ->where('is_split',1)->count();

        $data       =   [
            'language_id'       =>  $language_id,
            'csv_path'          =>  'uploads/'.$file_name,
            'status'            =>  'pending',
            'versions'          =>  $language_id.'.'.$dic_upload,
            'is_json_completed' =>  0
        ];
        DictionaryUpload::create($data);

        return response()->json([
            'success'   =>  true
        ],200);
    }

}
