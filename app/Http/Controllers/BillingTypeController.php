<?php

namespace App\Http\Controllers;

use App\Models\BillingFrequency;
use App\Models\BillingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasAnyRole('Operations Manager|Admin|BPO Director|Head of Operations|Operations Manager|Human Resouce Manager|Human Resouce Executive')){
            $types=BillingType::all();

            return  view('billing_type.index')->with('types',$types);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $name=$request->input('name');

        $type=BillingType::create([
            'name'=>$name
        ]);

        if ($type){
            return  redirect()->route('billing_type.index')->with('success','Billing type created successfully');
        }
        return  redirect()->route('billing_type.index')->with('error','Billing type not created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BillingType  $billingType
     * @return \Illuminate\Http\Response
     */
    public function show(BillingType $billingType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BillingType  $billingType
     * @return \Illuminate\Http\Response
     */
    public function edit(BillingType $billingType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BillingType  $billingType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BillingType $billingType)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $name=$request->input('name');

        $billingType->name=$name;

        if ($billingType->save()){
            return  redirect()->route('billing_type.index')->with('success','Updated successfully');
        }
        return  redirect()->route('billing_type.index')->with('error','Billing type not updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BillingType  $billingType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BillingType $billingType)
    {
        if ($billingType->delete()){
            return  redirect()->route('billing_type.index')->with('success','Billing type deleted successfully');

        }
        return  redirect()->route('billing_type.index')->with('error','Billing type not deleted');
    }
}
