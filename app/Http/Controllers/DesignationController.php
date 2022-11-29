<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasAnyRole('Operations Manager|Admin|BPO Director|Head of Operations|Operations Manager|Human Resouce Manager|Human Resouce Executive')){
            $designations=Designation::all();

            return  view('designation.index')->with('designations',$designations);
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

        $designation=Designation::create([
            'name'=>$name
        ]);

        if ($designation){
            return  redirect()->route('designation.index')->with('success','Designation created successfully');
        }
        return  redirect()->route('designation.index')->with('error','Designation not created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        return view('designation.show', [
            'designation'=>$designation, 
            'employees'=>Employee::all(), 
            'designations'=>designation::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Designation $designation)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $name=$request->input('name');

        $designation->name=$name;

        if ($designation->save()){
            return  redirect()->route('designation.index')->with('success','Updated successfully');
        }
        else{
        return  redirect()->route('designation.index')->with('error','Desination  not updated');
     }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Designation $designation)
    {
        if ($designation->delete()){
            return  redirect()->route('designation.index')->with('success','Designation deleted successfully');

        }
        return  redirect()->route('designation.index')->with('error','Designation not deleted');
    }

    public function allocate_employees(Request $request, Designation $designation){
        // dd($request->all());
        $request->validate([
            'employee_ids'=>'required|array',
        ]);
        foreach($request->employee_ids as $employee_id){
            Employee::findOrFail($employee_id)->update(['designation_id'=>$designation->id]);
        }
        return back()->with('success', "Done!");
    }
    public function re_allocate_employee(Employee $employee, Request $request)
    {
        // dd ($request->all());
        
        $employee = Employee::findOrFail($request->employee_id);
        $employee->update(['designation_id' => $request->new_designation_id]);
        return back()->with('success', "Done! {$employee->name} has been re-allocated");
    }
}
