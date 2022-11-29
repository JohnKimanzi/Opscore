<?php

namespace App\Http\Controllers;

use App\Models\Appraisal;
use App\Models\AppraisalSectionResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppraisalSectionResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return dd(AppraisalSectionResult::first()->resultable);
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
        $validator=Validator::make($request->all(),[
            'resultable_id'=>'required',
            'appraisee_rating'=>''
        ]);
        $as=AppraisalSectionResult::create([
            'appraisal_id'=>Appraisal::latest()->first()->id,
            'resultable_type'=>'AppraisalSectionA',
            'resultable_id'=>1,
            'target_performance'=>90,
            'actual_performance'=>90,
            'appraisee_rating'=>5,
            'appraiser_rating'=>5,
            'appraisee_remarks'=>"very good",
            'appraiser_remarks'=>'very good',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppraisalSectionResult  $appraisalSectionResult
     * @return \Illuminate\Http\Response
     */
    public function show(AppraisalSectionResult $appraisalSectionResult)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppraisalSectionResult  $appraisalSectionResult
     * @return \Illuminate\Http\Response
     */
    public function edit(AppraisalSectionResult $appraisalSectionResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppraisalSectionResult  $appraisalSectionResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppraisalSectionResult $appraisalSectionResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppraisalSectionResult  $appraisalSectionResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppraisalSectionResult $appraisalSectionResult)
    {
        //
    }
}
