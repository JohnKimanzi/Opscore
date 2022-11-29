<?php

namespace App\Http\Controllers;

use App\Models\LeaveCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LeaveCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hrm.leaves.leave-type', ['cats'=>LeaveCategory::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $rules=array([
                'name'=>'required|string',
                'description'=>'nullable|string',
                'days'=>'required|numeric'
            ]);
            $this->validate($request, $rules);

            LeaveCategory::create([
                'name'=>$request->name,
                'description'=>$request->description,
                'days'=>  $request->days
            ]);
            return Redirect::back()->with('success', "new type created successfully");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LeaveCategory  $leaveCategory
     * @return \Illuminate\Http\Response
     */
    public function show(LeaveCategory $leaveCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LeaveCategory  $leaveCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveCategory $leaveCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LeaveCategory  $leaveCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaveCategory $leaveCategory)
    {
        //
        $data=$request->all();


        $leaveCategory->name=$request->name;
        $leaveCategory->description=$request->description;
        $leaveCategory->days=$request->days;

        $leaveCategory->save();

        return Redirect::back()->with('success', "Category updated successfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LeaveCategory  $leaveCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveCategory $leaveCategory)
    {
        //
    }
}
