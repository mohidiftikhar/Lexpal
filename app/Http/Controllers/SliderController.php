<?php

namespace App\Http\Controllers;

use App\DataTables\SliderDataTable;
use App\Http\Requests\AppLinkId;
use App\Http\Requests\EditSliderRequest;
use App\Http\Requests\LinkRequest;
use App\Http\Requests\SliderRequest;
use App\Http\Requests\SliderRequestId;
use App\Models\App_link;
use App\Models\Slider;
use App\Models\SliderLink;
use App\Repositories\app_links\AppLinksInterface;
use App\Repositories\slider_links\SliderLinksInterface;
use App\Repositories\sliders\SliderInterface;
use App\Repositories\sliders\SliderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Throwable;

class SliderController extends Controller
{
    protected $sliderRepository;
    protected $appLinksRepository;
    protected $sliderLinkRepository;
    public function __construct(AppLinksInterface $appLinksRepository, SliderInterface $sliderRepository, SliderLinksInterface $sliderLinkRepository){
        $this->appLinksRepository = $appLinksRepository;
        $this->sliderRepository = $sliderRepository;
        $this->sliderLinkRepository = $sliderLinkRepository;
    }
    public function index(SliderDataTable $dataTable){
        return $dataTable->render('sliders.index');
    }
    public function create(){
        $app = $this->appLinksRepository->all();
        return view('sliders.create',compact('app'));
    }
    public function store(SliderRequest $sliderRequest){
       // dd($sliderRequest);
        //dd($sliderRequest->all());
            $file = $sliderRequest->file('image');
            $file_ext = $sliderRequest->file('image')->clientExtension();
            $destinationPath = public_path().'/uploads/images';
            $from_file_name  =   "from_".strtotime(date('Y-m-d H:i:s')).".".$file_ext;
            $file->move($destinationPath,$from_file_name);
            $slider_data = ['image' =>'uploads/images/'.$from_file_name,'heading' => $sliderRequest['heading'], 'description'=>$sliderRequest['description']];
            $store = $this->sliderRepository->create($slider_data);
            if (isset($store)){
                if(!empty($sliderRequest['app_link_id'])){
                    foreach ($sliderRequest['app_link_id'] as $appId){
                        $link_data = ['app_link_id'=>$appId,'slider_id'=>$store->id];
                        $this->sliderLinkRepository->create($link_data);
                    }
                }
            }
            if($store){
                return redirect()->route('sliders.index')->with('success', 'Slider added successfully');
            }
            else{
                return redirect()->route('sliders.create')->with('error','Something went wrong');
            }

    }
    public function edit(SliderRequestId $request, $id)
    {
        $slider = $this->sliderRepository->findById($id);
        $app = $this->appLinksRepository->all();
        $app_links = $this->sliderLinkRepository->findByFields(['slider_id'=>$id]);
        if ($slider){
            return view('sliders.edit', compact('slider','app','app_links'));
        }
        else{
            return redirect()->route('sliders.index')->withErrors('Something went wrong');
        }
    }
    public function update(EditSliderRequest $request, $id){
        //dd($request['image']);
        if (!empty($request->file('image'))){
            if (File::exists(public_path($request['image']))){
                @unlink(public_path($request['image']));
            }
            $file = $request->file('image');
            $file_ext = $request->file('image')->clientExtension();
            $destinationPath = public_path().'/uploads/images';
            $from_file_name  =   "from_".strtotime(date('Y-m-d H:i:s')).".".$file_ext;
            $file->move($destinationPath,$from_file_name);
            $from_file_name    =    'uploads/images/'.$from_file_name;
        }
        else{
            $image = $this->sliderRepository->findById($id);
            $from_file_name =   $image['image'];
        }
        $slider_data           =   [
            'image'     =>  $from_file_name,
            'heading'     =>  $request['heading'],
            'description'     =>  $request['description'],
        ];
        if(isset($request['app_link_id'])){
        $app_link = $this->sliderLinkRepository->findByFields(['slider_id'=>$id]);
        foreach ($app_link as $app_id){
            $this->sliderLinkRepository->delete($app_id['id']);
        }
        foreach ($request['app_link_id'] as $appId){
            $link_data = ['app_link_id'=>$appId,'slider_id'=>$id];
            $this->sliderLinkRepository->create($link_data);
        }
        }
            $update = $this->sliderRepository->update($id,$slider_data);

        if($update){
            return redirect()->route('sliders.index')->with('success','Slider updated Successfully.');
        }
        else{
            return redirect()->route('sliders.index')->with('error','Unable to update');
        }
    }
    public function destroy(SliderRequestId $request, $id)
    {
        $delete = $this->sliderRepository->delete($id);
        if($delete){
            return redirect()->route('sliders.index')->with('success', 'Deleted successfully');
        }
        else{
            return redirect()->route('sliders.index')->withErrors('Something went wrong');
        }
    }
}
