<?php

namespace App\Http\Controllers;

use App\DataTables\LangFlagTableDataTable;
use App\Http\Requests\LangFlagRequest;
use App\Models\LangFlag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LangFlagController extends Controller
{
    public function index(LangFlagTableDataTable $dataTable){
        return $dataTable->render('flags.index');
    }
    public function create(){
        return view('flags.create');
    }
    public function store(LangFlagRequest $request){

        $lang_flag      =   LangFlag::where('lang_name',$request['lang_name'])->first();
        if ($lang_flag){
            return redirect()->route('flags.index')->with('warning','Language already added.');
        }
        $file = $request->file('image_url');
        $destinationPath = public_path().'/uploads/images';
        $from_file_name  =   "from_".strtotime(date('Y-m-d H:i:s')).".png";
        $file->move($destinationPath,$from_file_name);

        $data           =   [
            'lang_name'     =>  $request['lang_name'],
            'image_url'     =>  'uploads/images/'.$from_file_name,
        ];
        LangFlag::create($data);
        return redirect()->route('flags.index')->with('success','Language Added Successfully.');
    }
    public function edit($id){
        $lang_flag      =   LangFlag::find($id);
        return view('flags.edit',compact('lang_flag'));
    }
    public function update(Request $request,$id){
        $lang_flag      =   LangFlag::find($id);
        $from_file_name =   '';
        if (!empty($request->file('image_url'))){
            if (File::exists(public_path($lang_flag->image_url))){
                @unlink(public_path($lang_flag->image_url));
            }
            $file = $request->file('image_url');
            $destinationPath = public_path().'/uploads/images';
            $from_file_name  =   "from_".strtotime(date('Y-m-d H:i:s')).".png";
            $file->move($destinationPath,$from_file_name);
            $from_file_name    =    'uploads/images/'.$from_file_name;
        }
        else{
            $from_file_name =   $lang_flag->image_url;
        }
        $data           =   [
            'lang_name'     =>  $request['lang_name'],
            'image_url'     =>  $from_file_name,
        ];
        $lang_flag->update($data);
        return redirect()->route('flags.index')->with('success','Language update Successfully.');
    }
}
