<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Repositories\settings\SettingInterface;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $settingRepository;
    public function __construct(SettingInterface $settingRepository){
        $this->settingRepository = $settingRepository;
    }
    public function create(){
        $setting = $this->settingRepository->findById(1);
        if ($setting) {
            return view('settings.create',compact('setting'));
        } else {
            return redirect()->route('settings.create')->withErrors('Something went wrong');
        }
    }
    public function update(SettingRequest $request){
        $update = $this->settingRepository->update(1, $request->all());
        if ($update) {
            $setting = $this->settingRepository->findById(1);
            return redirect()->route('settings.create',compact('setting'))->with('success','Settings updated successfully');
        } else {
            return redirect()->route('settings.create')->withErrors('Something went wrong');
        }
    }

}
