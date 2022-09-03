<?php

namespace App\Http\Controllers;

use App\DataTables\NavigationDataTable;
use App\Http\Requests\NavigationRequest;
use App\Models\NavigationBar;
use App\Repositories\navigation\NavigationInterface;
use App\Repositories\pages\PageInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NavigationController extends Controller
{
    protected $nevigationRepository;
    protected $pageRepository;

    public function __construct(NavigationInterface $nevigationRepository, PageInterface $pageRepository){
    $this->nevigationRepository = $nevigationRepository;
    $this->pageRepository = $pageRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NavigationDataTable $dataTable)
    {
        return $dataTable->render('navigation/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('navigation/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NavigationRequest $request)
    {
        $store = $this->nevigationRepository->create($request->all());
        if ($store) {
            return redirect()->route('navigation.index')->with('success', 'Added to Navigation Bar successfully');
        } else {
            return redirect()->route('navigation.create')->withErrors('Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NavigationBar  $navigation
     * @return \Illuminate\Http\Response
     */
    public function show(NavigationBar $navigation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NavigationBar  $navigation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $navigation = $this->nevigationRepository->findById($id);
        return view('navigation/edit',compact('navigation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NavigationBar  $navigation
     * @return \Illuminate\Http\Response
     */
    public function update(NavigationRequest $request,$id)
    {
        $url = $this->nevigationRepository->findById($id);
        $pages = $this->pageRepository->findByFields(['name'=>$url['url']]);
        $slug = Str::slug($request['url']);
        $update = $this->nevigationRepository->update($id,['name'=>$request['name'],'url'=>$slug,'status'=> $request['status']]);
        if($update){
            if($pages){
                foreach($pages as $page){
                    $this->pageRepository->update($page->id,['name'=>$slug,'heading'=>$page['heading'], 'content'=>$page['content'],'header' =>$page['header'],'footer' =>$page['footer'],'bg' =>$page['bg']]);
                }
            }
            return redirect()->route('navigation.index')->with('success', 'Navigation item updated successfully');
        }
        else{
            return redirect()->route('navigation.index')->withErrors('Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NavigationBar  $navigation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->nevigationRepository->delete($id);
        if($delete){
            return redirect()->route('navigation.index')->with('success', 'Navigation item deleted successfully');
        }
        else{
            return redirect()->route('navigation.index')->withErrors('Something went wrong');
        }
    }
    public function change($id){
        $license = $this->nevigationRepository->findById($id);
        if($license['status']== 'active'){
            $this->nevigationRepository->update($id, ['status'=> 'deactive']);
        }
        else{
            $this->nevigationRepository->update($id, ['status'=>'active']);
        }
        return redirect()->route('navigation.index')->with('success', 'Status Changed successfully');
    }
}
