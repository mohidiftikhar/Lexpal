<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Repositories\admin\AdminInterface;

class AdminController extends Controller
{
    protected $adminRepository;

    public function __construct(AdminInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }
    public function login_page(){
        return view('auth.admin_login');
    }
    public function admin_login(AdminRequest $request){
        $response = $this->adminRepository->admin_login($request->only('email','password'));
        if($response['status'] === true){
            return redirect()->route('admin.dashboard')->with($response['msg']);
        }
        else{
            return redirect()->route('admin.login')->withErrors($response['msg']);
        }
    }
}
