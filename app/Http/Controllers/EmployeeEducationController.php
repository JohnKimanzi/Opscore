<?php

namespace App\Http\Controllers;

use App\Models\EmployeeEducation;
use Illuminate\Http\Request;

class EmployeeEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $rules=array([
            'ed_institution_name',
            'ed_level',
            'ed_undertaking',
            'ed_score',
            'ed_start_date',
            'ed_end_date',
            'ed_comments',
        ]);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeEducation  $employeeEducation
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeEducation $employeeEducation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeEducation  $employeeEducation
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeEducation $employeeEducation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeEducation  $employeeEducation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeEducation $employeeEducation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeEducation  $employeeEducation
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeEducation $employeeEducation)
    {
        //
    }
}
