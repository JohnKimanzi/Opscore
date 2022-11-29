<?php

namespace App\Http\Controllers;

use App\Models\Appraisal;
use App\Models\AppraisalSectionA;
use App\Models\AppraisalSectionResult;
use Illuminate\Http\Request;

class AppraisalSectionAController extends Controller
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
        $as=AppraisalSectionResult::create([
            'appraisal'=>Appraisal::first()->id,
            'sectionable_type'=>'AppraisalSectionA',
            'sectionable_id'=>1,
            'target_performance'=>90,
            'actual_performance'=>90,
            'appraisee_rating'=>5,
            'appraiser_rating'=>5,
            'appraisee_remarks'=>"very good",
            'appraiser_remarks'=>'very good',
        ]);
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
     * @param  \App\Models\AppraisalSectionA  $appraisalSectionA
     * @return \Illuminate\Http\Response
     */
    public function show(AppraisalSectionA $appraisalSectionA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppraisalSectionA  $appraisalSectionA
     * @return \Illuminate\Http\Response
     */
    public function edit(AppraisalSectionA $appraisalSectionA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppraisalSectionA  $appraisalSectionA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppraisalSectionA $appraisalSectionA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppraisalSectionA  $appraisalSectionA
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppraisalSectionA $appraisalSectionA)
    {
        //
    }
}
