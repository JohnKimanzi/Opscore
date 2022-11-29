<?php

namespace App\Http\Controllers;

use App\Models\Appraisal;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppraisalReportController extends Controller
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

    public  function  done(){

        if(Auth::user()->hasAnyRole('Human Resource Manager|Admin|BPO Director|Operations Manager|Human Resouce Manager|Human Resouce Executive')){
            $appraisals=Appraisal::with('employee')
                ->with('employee.department')
                ->with('employee.project')
                ->with('employee.designation')
                ->get();

            return view('appraisals.report.completed')->with('appraisals',$appraisals);

        }

        return abort(403, 'Unauthorized');

    }


    public  function  pending(){

        if(Auth::user()->hasAnyRole('Human Resource Manager|Admin|BPO Director|Operations Manager|Human Resouce Manager|Human Resouce Executive')){
            $appraisals=Employee::with('department')
                ->with('designation')
                ->with('project')
                ->has('appraisals','<=',0)
                ->get();

            return view('appraisals.report.pending')->with('appraisals',$appraisals);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
