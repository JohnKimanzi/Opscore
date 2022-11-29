<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecruitmentController extends Controller
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'id_number'=>'required',
            'phone1'=>'required',
            'phone2'=>'required',
            'email'=>'required',
            'residence'=>'required',
            'marital_status'=>'required',
            'gender'=>'required',
            'country'=>'required',
            'level_of_education'=>'required',
            'course'=>'required',
            'work_experience'=>'required',
            'years_of_experience'=>'required',
            'area_of_experience'=>'required',
            'employment_status'=>'required',
            'job_info'=>'required',
            'salary_expectation'=>'required'
        ]);

        $recruitment=Recruitment::create([
            'id_number'=>$request->id_number,
            'phone1'=>$request->phone1,
             'email'=>$request->email,
            'residence'=>$request->residence,
            'marital_status'=>$request->marital_status,
            'gender'=>$request->gender,
            'country_id'=>$request->country,
            'level_of_education'=>$request->level_of_education,
            'course'=>$request->course,
            'work_experience'=>$request->work_experience,
            'years_of_experience'=>$request->years_of_experience,
            'area_of_experience'=>$request->area_of_experience,
            'employment_status'=>$request->employment_status,
            'job_info'=>$request->job_info,
            'salary_expectation'=>$request->salary_expectation
        ]);

        if ($recruitment){
            return  response()->json([
                'status'=>true,
                'message'=>'success'
            ]);
        }

        return  response()->json([
            'status'=>false,
             'message'=>'Failed'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function show(Recruitment $recruitment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function edit(Recruitment $recruitment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recruitment $recruitment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recruitment $recruitment)
    {
        //
    }
}
