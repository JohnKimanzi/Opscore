<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasAnyRole(['Operations Manager','Admin','BPO Director','Head of Operations','Operations Manager','Human Resource Manager','Human Resource Executive'])){

            $departments=Department::all();

            return  view('hrm.departments.index')->with('departments',$departments);
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

        $department=Department::create([
            'name'=>$name
        ]);

        if ($department){
            return  redirect()->route('department.index')->with('success','Department created successfully');
        }
        return  redirect()->route('department.index')->with('error','Department not created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('hrm.departments.show', [
            'department'=>$department, 
            'employees'=>Employee::all(), 
            'departments'=>Department::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $name=$request->input('name');

        $department->name=$name;

        if ($department->save()){
            return  redirect()->route('department.index')->with('success','Updated successfully');
        }
        return  redirect()->route('department.index')->with('error','Department  not updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Department $department): \Illuminate\Http\RedirectResponse
    {
        if ($department->delete()){
            return  redirect()->route('department.index')->with('success','Department deleted successfully');

        }
        return  redirect()->route('department.index')->with('error','Department not deleted');
    }
    public function allocate_employees(Request $request, Department $department){
        // dd($request->all());
        $request->validate([
            'employee_ids'=>'required|array',
        ]);
        foreach($request->employee_ids as $employee_id){
            Employee::findOrFail($employee_id)->update(['department_id'=>$department->id]);
        }
        return back()->with('success', "Done!");
    }
    public function re_allocate_employee(Employee $employee, Request $request)
    {
        // dd ($request->all());
        
        $employee = Employee::findOrFail($request->employee_id);
        $employee->update(['department_id' => $request->new_dept_id]);
        return back()->with('success', "Done! {$employee->name} has been re-allocated");
    }
    public function department_employees(Department $department, Employee $employee)
    {
        
       return view('hrm.employees.index', [
           'department'=>$department,
           'employees'=>$department->employees]);
    }
}
