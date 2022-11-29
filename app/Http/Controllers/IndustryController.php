<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasAnyRole('Operations Manager|Admin|BPO Director|Head of Operations|Operations Manager|Human Resouce Manager|Human Resouce Executive')){
            $industries=Industry::all();
            return   view('industry.index')->with('industries',$industries);
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

        $industry=Industry::create([
            'name'=>$name,
            'description'=>$name
        ]);

        if ($industry){
            return  redirect()->route('industry.index')->with('success','Industry created successfully');
        }
        return  redirect()->route('industry.index')->with('error','Industry not created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function show(Industry $industry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function edit(Industry $industry)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Industry  $industry
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Industry $industry)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $name=$request->input('name');

        $industry->name=$name;

        if ($industry->save()){
            return  redirect()->route('industry.index')->with('success','Updated successfully');
        }
        return  redirect()->route('industry.index')->with('error','Industry  not updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Industry $industry)
    {
        if ($industry->delete()){
            return  redirect()->route('industry.index')->with('success','Deleted successfully');
        }
    }
}
