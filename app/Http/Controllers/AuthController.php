<?php

namespace App\Http\Controllers;

use App\Http\Requests\LicenseRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\admin\AdminInterface;
use App\Repositories\app_links\AppLinksInterface;
use App\Repositories\language\LanguageInterface;
use App\Repositories\license\LicenseInterface;
use App\Repositories\navigation\NavigationInterface;
use App\Repositories\pages\PageInterface;
use App\Repositories\plans\PlanInterface;
use App\Repositories\products\ProductInterface;
use App\Repositories\questions\QuestionInterface;
use App\Repositories\sliders\SliderInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Dcblogdev\MsGraph\Facades\MsGraph;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    protected $licenseRepository;
    protected $adminRepository;
    protected $languageRepository;
    protected $app_linksRepository;
    protected $sliderRepository;
    protected $questionRepository;
    protected $productRepository;
    protected $planRepository;
    protected $navigationRepository;
    protected $pageRepository;

    public function __construct(PageInterface $pageRepository,NavigationInterface $navigationRepository,PlanInterface $planRepository,ProductInterface $productRepository,QuestionInterface $questionRepository,SliderInterface $sliderRepository,AppLinksInterface $app_linksRepository,LicenseInterface $licenseRepository, AdminInterface $adminRepository,LanguageInterface $languageRepository)
    {
        $this->licenseRepository = $licenseRepository;
        $this->adminRepository =$adminRepository;
        $this->languageRepository = $languageRepository;
        $this->app_linksRepository =$app_linksRepository;
        $this->sliderRepository =$sliderRepository;
        $this->questionRepository= $questionRepository;
        $this->productRepository = $productRepository;
        $this->planRepository = $planRepository;
        $this->navigationRepository = $navigationRepository;
        $this->pageRepository = $pageRepository;
    }
    public function dashboard(){
        $user = $this->adminRepository->count();
        $language = $this->languageRepository->count();
        $app_link = $this->app_linksRepository->count();
        $slider = $this->sliderRepository->count();
        $question = $this->questionRepository->count();
        $product = $this->productRepository->count();
        $plan = $this->planRepository->count();
        $navigation = $this->navigationRepository->count();
        $page = $this->pageRepository->count();
        $CSV = DB::table("csv_parts")->count();

        return view('dashboard', compact('user','language','app_link','slider','question','product','CSV','plan','navigation','page'));
    }

    public function change_password(Request $request){
        return view('auth.change-password');
    }
    public function changePasswordStore(Request $request){
        $request->validate([
            'old_password'  =>  'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user       =   User::find(auth()->user()->id);
        $old_password           =   $request['old_password'];

        if (auth()->attempt(['email'     =>  $user->email, 'password'  =>  $old_password])){
            if ($user){
                $user->update([
                    'password'      =>  Hash::make($request['password'])
                ]);
                return redirect()->route('auth.change-password')->with('success','Your password are successfully change');
            }
        }
        return redirect()->route('auth.change-password')->with('danger','Your old is not correct.');
    }
    public function editProfile(Request $request){
        $id = auth()->user()->id;
        $user       =   $this->adminRepository->findById($id);
        //dd($user['images']);
        return view('auth.edit-profile',compact('user'));
    }
    public function  editProfileStore(UserRequest $request){
        //dd($request->file('image'));
        $id = auth()->user()->id;
        $user       =   $this->adminRepository->findById($id);
        if (!empty($request->file('image'))){
            //dd(1);
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
            $from_file_name =   $user['images'];
            //dd($from_file_name);
        }
        $data           =   [
            'images'     =>  $from_file_name,
            'name'     =>  $request['name'],
            'email'     =>  $request['email'],
        ];
        $update = $this->adminRepository->update($id,$data);

        if ($update){
            return redirect()->route('auth.profile')->with('success','Your Profile update successfully.');
        }
        return redirect()->route('auth.profile')->with('danger','Error occur . please try later');
    }

    public function socialRedirect($driver)
    {
       return Socialite::driver($driver)->redirect();
    }
    public function socialCallback($driver)
    {
        $user = Socialite::driver($driver)->user();
        $email =$user->email;
        $domain_name = substr(strrchr($email, "@"), 1);
        //dd($user->email);
        $check = $this->licenseRepository->checkLicense($driver,$domain_name,'web');
//        dd($check);
        if($check){
            $license = json_decode($check);
            if ($license->expiry_date >= Carbon::now()->format('Y-m-d') && $license->status =='active') {
                $user_exist = $this->adminRepository->createIfNotExist(['social_type' => $driver, 'email' => $user->email, 'name' => $user->name, 'role_id' => 2,'license_id'=>$license->id]);
                Auth::loginUsingId($user_exist->id);
                notify()->success('Logged in Successfully');
                return redirect()->route('home');
            }
            else{
                notify()->error('Your license has expired');
                return redirect()->route('home');
            }
        }
        else{
            notify()->error('User has no license');
            return redirect()->route('home');
        }

    }

}
