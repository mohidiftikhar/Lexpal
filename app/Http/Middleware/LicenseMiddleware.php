<?php

namespace App\Http\Middleware;

use App\Repositories\license\LicenseInterface;
use App\Repositories\license\LicenseRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LicenseMiddleware
{
    protected $licenseRepository;
    public function __construct(LicenseInterface $licenseRepository){
        $this->licenseRepository = $licenseRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
//    protected $licenseRepository;
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
//            dd(Auth::user()->licenses_id);
            $license = $this->licenseRepository->findById(Auth::user()->license_id);
            if($license->status == 'active'){
                return $next($request);
            }
            else{
                Auth::logout();
                return redirect()->route('home');
            }
        }
        else{
            return redirect()->route('home');
        }
    }
}
