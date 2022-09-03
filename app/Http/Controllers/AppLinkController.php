<?php

namespace App\Http\Controllers;

use App\DataTables\AppLinkDataTable;
use App\Http\Requests\AppLinkId;
use App\Http\Requests\AppLinksRequest;
use App\Http\Requests\EditAppLinkRequest;
use App\Repositories\app_links\AppLinksInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AppLinkController extends Controller
{
    protected $appLinksRepository;
    public function __construct(AppLinksInterface $appLinksRepository){
        $this->appLinksRepository = $appLinksRepository;
    }
    public function index(AppLinkDataTable $dataTable){
        return $dataTable->render('app_links.index');
    }
    public function create(){
        return view('app_links.create');
    }
    public function store(AppLinksRequest $request){
        $file = $request->file('icon');
        $file_ext = $request->file('icon')->clientExtension();
        $destinationPath = public_path().'/uploads/images';
        $from_file_name  =   "from_".strtotime(date('Y-m-d H:i:s')).".".$file_ext;
        $file->move($destinationPath,$from_file_name);
        $data = ['icon' =>'uploads/images/'.$from_file_name,'short_heading' => $request['short_heading'], 'heading'=>$request['heading'], 'url'=>$request['url']];
        $store = $this->appLinksRepository->store($data);
        if($store){
            return redirect()->route('app_links.index')->with('success', 'App Link added successfully');
        }
        else{
            return redirect()->route('app_links.create')->withErrors('Something went wrong');
        }
    }
    public function edit(AppLinkId $request, $id)
    {
        $record = $this->appLinksRepository->findById($id);
        if ($record){
            return view('app_links.edit', compact('record'));
        }
        else{
            return redirect()->route('app_links.index')->withErrors('Something went wrong');
        }

    }
    public function update(EditAppLinkRequest $request,AppLinkId $requestId, $id){

        if (!empty($request->file('icon'))){
            if (File::exists(public_path($request['icon']))){
                @unlink(public_path($request['icon']));
            }
            $file = $request->file('icon');
            $file_ext = $request->file('icon')->clientExtension();
            $destinationPath = public_path().'/uploads/images';
            $from_file_name  =   "from_".strtotime(date('Y-m-d H:i:s')).".".$file_ext;
            $file->move($destinationPath,$from_file_name);
            $from_file_name    =    'uploads/images/'.$from_file_name;
        }
        else{
            $icon = $this->appLinksRepository->findById($id);
            $from_file_name =   $icon['icon'];
        }
        $data           =   [
            'icon'     =>  $from_file_name,
            'short_heading'     =>  $request['short_heading'],
            'heading'     =>  $request['heading'],
            'url'         => $request['url'],
        ];
        $update = $this->appLinksRepository->update($id,$data);
        if($update){
        return redirect()->route('app_links.index')->with('success','App Links update Successfully.');
        }
        else{
            return redirect()->route('app_links.index')->with('error','Unable to update');
        }
    }
    public function destroy(AppLinkId $request, $id)
    {
        $license = $this->appLinksRepository->delete($id);
        if($license){
            return redirect()->route('app_links.index')->with('success', 'Deleted successfully');
        }
        else{
            return redirect()->route('app_links.index')->withErrors('Something went wrong');
        }
    }
}
