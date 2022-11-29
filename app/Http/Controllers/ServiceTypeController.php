<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasAnyRole('Operations Manager|Admin|BPO Director|Head of Operations|Operations Manager|Human Resouce Manager|Human Resouce Executive')){
            $types=ServiceType::all();

            return  view('service_type.index')->with('types',$types);
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

        $serviceType=ServiceType::create([
            'name'=>$name
        ]);

        if ($serviceType){
            return  redirect()->route('service_type.index')->with('success','Service type created successfully');
        }
        return  redirect()->route('service_type.index')->with('error','service type not created');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceType $serviceType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceType $serviceType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceType  $serviceType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ServiceType $serviceType)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $name=$request->input('name');

        $serviceType->name=$name;

        if ($serviceType->save()){
            return  redirect()->route('service_type.index')->with('success','Service type updated successfully');
        }
        return  redirect()->route('service_type.index')->with('error','Service type not updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceType  $serviceType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ServiceType $serviceType)
    {
        if ($serviceType->delete()){
            return  redirect()->route('service_type.index')->with('success','Service type deleted successfully');

        }
        return  redirect()->route('service_type.index')->with('error','Service type not deleted');

    }
}
