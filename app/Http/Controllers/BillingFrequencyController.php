<?php

namespace App\Http\Controllers;

use App\Models\BillingFrequency;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingFrequencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasAnyRole('Operations Manager|Admin|BPO Director|Head of Operations|Operations Manager|Human Resouce Manager|Human Resouce Executive')){
            $frequencies=BillingFrequency::all();

            return  view('billing_frequency.index')->with('frequencies',$frequencies);
        }
        return abort(403, 'Unauthorized');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $name=$request->input('name');

        $frequency=BillingFrequency::create([
            'name'=>$name
        ]);

        if ($frequency){
            return  redirect()->route('billing_frequency.index')->with('success','Billing Frequency created successfully');
        }
        return  redirect()->route('billing_frequency.index')->with('error','Billing Frequency not created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BillingFrequency  $billingFrequency
     * @return \Illuminate\Http\Response
     */
    public function show(BillingFrequency $billingFrequency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BillingFrequency  $billingFrequency
     * @return \Illuminate\Http\Response
     */
    public function edit(BillingFrequency $billingFrequency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BillingFrequency  $billingFrequency
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BillingFrequency $billingFrequency)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $name=$request->input('name');

        $billingFrequency->name=$name;

        if ($billingFrequency->save()){
            return  redirect()->route('billing_frequency.index')->with('success','Updated successfully');
        }
        return  redirect()->route('billing_frequency.index')->with('error','Billing Frequency not updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BillingFrequency  $billingFrequency
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BillingFrequency $billingFrequency)
    {
        if ($billingFrequency->delete()){
            return  redirect()->route('billing_frequency.index')->with('success','Billing Frequency deleted successfully');

        }
        return  redirect()->route('billing_frequency.index')->with('error','Billing Frequency not deleted');
    }
}
