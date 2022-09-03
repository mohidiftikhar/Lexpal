<?php

namespace App\Http\Controllers;

use App\DataTables\PlanDataTable;
use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use App\Repositories\plans\PlanInterface;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    protected $planRepository;
    public function __construct(PlanInterface $planRepository){
        $this->planRepository = $planRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PlanDataTable $dataTable)
    {
        return $dataTable->render('plans/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plans/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {
        $store = $this->planRepository->create($request->all());
        if ($store) {
            return redirect()->route('plans.index')->with('success', 'Plan added successfully');
        } else {
            return redirect()->route('plans.create')->withErrors('Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = $this->planRepository->findById($id);
        return view('plans/edit',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request, $id)
    {
        $update = $this->planRepository->update($id,$request->all());
        if($update){
            return redirect()->route('plans.index')->with('success', 'PLan updated successfully');
        }
        else{
            return redirect()->route('plans.index')->withErrors('Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->planRepository->delete($id);
        if($delete){
            return redirect()->route('plans.index')->with('success', 'Plan deleted successfully');
        }
        else{
            return redirect()->route('plans.index')->withErrors('Something went wrong');
        }
    }
    public function change($id){
        $license = $this->planRepository->findById($id);
        if($license['status']== 'active'){
            $this->planRepository->update($id, ['status'=> 'inactive']);
        }
        else{
            $this->planRepository->update($id, ['status'=>'active']);
        }
        return redirect()->route('plans.index')->with('success', 'Status Changed successfully');
    }
}
