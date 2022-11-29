<?php

namespace App\Http\Controllers;

use App\Models\NextOfKin;
use Illuminate\Http\Request;

class NextOfKinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rules=array([
            'employee_id',
            'relation',
            'kin_names',
            'kin_email',
            'kin_phone1',
            'kin_phone2'
        ]);
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
     * @param  \App\Models\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function show(NextOfKin $nextOfKin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function edit(NextOfKin $nextOfKin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NextOfKin $nextOfKin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function destroy(NextOfKin $nextOfKin)
    {
        //
    }
}
