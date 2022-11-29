<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\Designation;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $benefits=Benefit::all();

        return  view('benefit.index')->with('benefits',$benefits);
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

        $benefit=Benefit::create([
            'name'=>$name
        ]);

        if ($benefit){
            return  redirect()->route('benefit.index')->with('success','Benefit created successfully');
        }
        return  redirect()->route('benefit.index')->with('error','Benefit not created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Benefit  $benefit
     * @return \Illuminate\Http\Response
     */
    public function show(Benefit $benefit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Benefit  $benefit
     * @return \Illuminate\Http\Response
     */
    public function edit(Benefit $benefit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Benefit  $benefit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Benefit $benefit)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $name=$request->input('name');

        $benefit->name=$name;

        if ($benefit->save()){
            return  redirect()->route('benefit.index')->with('success','Updated successfully');
        }
        return  redirect()->route('benefit.index')->with('error','Benefit  not updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Benefit  $benefit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Benefit $benefit)
    {
        if ($benefit->delete()){
            return  redirect()->route('benefit.index')->with('success','Benefit deleted successfully');

        }
        return  redirect()->route('benefit.index')->with('error','Benefit not deleted');
    }
}
