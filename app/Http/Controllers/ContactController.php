<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Repositories\inquiry\InquiryInterface;
use App\Repositories\language\LanguageInterface;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $inquiryRepository;
    public function __construct(InquiryInterface $inquiryRepository)
    {
        $this->inquiryRepository = $inquiryRepository;
    }

    public function contact(ContactRequest $request)
    {
        $this->inquiryRepository->create($request->all());
        $send = $this->inquiryRepository->send($request['email'],$request['name'],$request['description']);
        if ($send == true){
            return true;
        }
        else{
            return false;
        }
    }
}
