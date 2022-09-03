<?php

namespace App\Http\Controllers;

use App\DataTables\PageDataTable;
use App\Http\Requests\EditPageRequest;
use App\Http\Requests\NavigationRequest;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Repositories\navigation\NavigationInterface;
use App\Repositories\pages\PageInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    protected $pageRepository;
    protected $navigationRepository;
    public function __construct(PageInterface $pageRepository, NavigationInterface $navigationRepository){
        $this->pageRepository = $pageRepository;
        $this->navigationRepository = $navigationRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PageDataTable $dataTable)
    {
        return $dataTable->render('pages/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $slug = Str::slug($request['name']);
        $store = $this->pageRepository->create(['name'=>$slug,'heading'=>$request['heading'], 'content'=>$request['content'],'header' =>$request['header'],'footer' =>$request['footer'],'bg' =>$request['bg']]);
        if($store){
            $navigation = $this->navigationRepository->create(['name'=>$request['name'],'url'=>$slug,'status'=> 'active']);
            return redirect()->route('pages.index')->with('success', 'Page added successfully');
        }
        else{
            return redirect()->route('pages.index')->withErrors('Something went wrong');
        }
    }

    public function upload(Request $request)
    {
        if($request->HasFile('upload')) {
            $file = $request->file('upload');
            $file_ext = $request->file('upload')->clientExtension();
            $destinationPath = public_path() . '/uploads/images';
            $from_file_name = "from_" . strtotime(date('Y-m-d H:i:s')) . "." . $file_ext;
            $file->move($destinationPath, $from_file_name);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('uploads/images/'.$from_file_name);
            $msg ='Image upload successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction('$CKEditorFuncNum','$url','$msg')</script>";
            @header('Content-type: text/html; charset-utf-8');
            echo $response;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = $this->pageRepository->findById($id);
        return view('pages/edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(EditPageRequest $request,$id)
    {
        $name = $this->pageRepository->findById($id);
        $navs = $this->navigationRepository->findByFields(['url'=>$name['name']]);
        $slug = Str::slug($request['name']);
        $update = $this->pageRepository->update($id,['name'=>$slug,'heading'=>$request['heading'], 'content'=>$request['content'],'header' =>$request['header'],'footer' =>$request['footer'],'bg' =>$request['bg']]);
        if($update){
            $updateId = $this->pageRepository->findById($id);
            foreach ($navs as $nav){
                    $this->navigationRepository->update($nav->id,['name'=>$updateId['name'],'url'=>$slug,'status'=> 'active']);
                    return redirect()->route('pages.index')->with('success', 'Page updated successfully');
            }
        }
        else{
            return redirect()->route('pages.index')->withErrors('Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $name = $this->pageRepository->findById($id);
        $navs = $this->navigationRepository->findByFields(['url'=>$name['name']]);
        $delete = $this->pageRepository->delete($id);
        if($delete){
            foreach ($navs as $nav){
                $this->navigationRepository->delete($nav->id);
                return redirect()->route('pages.index')->with('success', 'Page deleted successfully');
            }
        }
        else{
            return redirect()->route('pages.index')->withErrors('Something went wrong');
        }
    }
}
