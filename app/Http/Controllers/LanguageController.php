<?php

namespace App\Http\Controllers;

use App\DataTables\LanguagesDataTable;
use App\Http\Requests\LanguageRequest;
use App\Models\Dictionary_1;
use App\Models\LangFlag;
use App\Models\Language;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class LanguageController extends Controller
{
    public function index(LanguagesDataTable $dataTable){
        return $dataTable->render('languages.index');
    }
    public function create(){
        $langs      =   LangFlag::get();
        return view('languages.create',compact('langs'));
    }

    public function store(LanguageRequest $request){

        $language       =   Language::where('from',$request['from'])
            ->where('to',$request['to'])
            ->first();
        if ($language){
            return redirect()->route('languages.create')->with('warning',$request['from'].' to '.$request['to']." already exist.");
        }
        $lang_1     =   LangFlag::find($request['lang_1']);
        $lang_2     =   LangFlag::find($request['lang_2']);
        $data       =   [
            'from'          =>  $lang_1->lang_name??'',
            'to'            =>  $lang_2->lang_name??'',
            'is_active'     =>  1,
            'lang_1'        =>  $request['lang_1'],
            'lang_2'        =>  $request['lang_2'],
        ];
        $language       =   Language::create($data);
        $language_id    =   $language->id;
        $table_name     =   'dictionary_'.$language_id.'s';
        $language->update([
            'table_name'    =>  'App\Models\Dictionary_'.$language_id
        ]);
        if (!Schema::hasTable($table_name)){
            Schema::create($table_name, function (Blueprint $table) use($language_id){
                $table->id();
                $table->bigInteger('language_id')->default($language_id);
                $table->text('ids')->nullable();
                $table->text('entryword')->nullable();
                $table->text('inflactedform')->nullable();
                $table->text('topic')->nullable();
                $table->text('pos')->nullable();
                $table->text('pos_1')->nullable();
                $table->text('entryword_1')->nullable();
                $table->text('inflactedform_1')->nullable();
                $table->text('dn_type')->nullable();
                $table->text('l1_sentence')->nullable();
                $table->text('l2_sentence')->nullable();
            });
            Artisan::call('make:model Dictionary_'.$language_id);
        }
        return redirect()->route('languages.index')->with('success','Languages added successfully');
    }
}
