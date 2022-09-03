<?php

namespace App\Http\Controllers;

use App\DataTables\LicensesDataTable;
use App\Http\Requests\LicenseRequest;
use App\Http\Requests\LicenseRequestId;
use App\Models\LangFlag;
use App\Models\License;
use App\Repositories\license\LicenseInterface;
use App\Repositories\products\ProductInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    protected $licenseRepository;
    protected $productRepository;

    public function __construct(LicenseInterface $licenseRepository, ProductInterface $productRepository)
    {
        $this->licenseRepository = $licenseRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LicensesDataTable $dataTable)
    {
        return $dataTable->render('licenses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productRepository->all();
        return view('licenses.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(LicenseRequest $request)
    {
        unset($request['_token']);
        $check = $this->licenseRepository->findByFields(['social_type'=>$request['social_type'],'product_id'=>$request['product_id'],'domain_name'=>$request['domain_name']]);
        if($check != '[]'){
            return redirect()->route('licenses.create')->withErrors('License already exist');
        }
        else{
            $license = $this->licenseRepository->createIfNotExist(['social_type'=>$request['social_type'],'product_id'=>$request['product_id'],'domain_name'=>$request['domain_name']],$request->all());
            if($license){
                return redirect()->route('licenses.index')->with('success', 'License added successfully');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\License $license
     * @return \Illuminate\Http\Response
     */
    public function edit(LicenseRequestId $request, $id)
    {
            $license = $this->licenseRepository->findById($id);
            $products = $this->productRepository->all();
            if ($license){
                return view('licenses.edit', compact('license','products'));
            }
            else{
                return redirect()->route('licenses.index')->withErrors('Something went wrong');
            }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\License $license
     * @return \Illuminate\Http\Response
     */
    public function update(LicenseRequest $request, $id)
    {
        //dd($id);
//        dd($request->all());
        $license = $this->licenseRepository->update($id, $request->all());

        if($license){
            return redirect()->route('licenses.index')->with('success', 'License updated successfully');
        }
        else{
            return redirect()->route('licenses.index')->withErrors('Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\License $license
     * @return \Illuminate\Http\Response
     */
    public function destroy(LicenseRequestId $request, $id)
    {
            $license = $this->licenseRepository->delete($id);
            if($license){
                return redirect()->route('licenses.index')->with('success', 'Deleted successfully');
            }
            else{
                return redirect()->route('licenses.index')->withErrors('Something went wrong');
            }
    }
    public function change(LicenseRequestId $request, $id){
        $license = $this->licenseRepository->findById($id);
//        dd(Carbon::now());
        if($license['expiry_date'] >= Carbon::now()->format('Y-m-d')){
        if($license['status']== 'active'){
            $this->licenseRepository->update($id, ['status'=> 'inactive']);
        }
        else{
            $this->licenseRepository->update($id, ['status'=>'active']);
        }
        return redirect()->route('licenses.index')->with('success', 'Status Changed successfully');
        }
        else{
            if($license['status']== 'active'){
                $this->licenseRepository->update($id, ['status'=> 'inactive']);
            }
            return redirect()->route('licenses.index')->withErrors('License expired');
        }
    }
}
