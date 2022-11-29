<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('policies.index', ['policies'=>Policy::all()]);
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
        // dd('here');
        $request->validate([
            'name'=>'required|string',
            'description'=>'nullable|string',
            'group'=>'required|string',
            'effective_date'=>'date|required',
            'doc'=>'required|file|mimes:pdf|max:5120',
        ]);

        $doc=$request->file('doc');
        $filename=$doc->getClientOriginalName();
        $path='app/policies';
        // $templateProcessor->saveAs(storage_path($path));
        $path = $doc->storeAS($path, $filename); 

        $policy=Policy::create([
            'name'=>$request->name,
            'group'=>$request->group,
            'effective_date'=>$request->effective_date,
            'description'=>$request->description,
            'filepath'=>$path,
        ]);
        return Redirect::back()->with('success', 'Policy created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function edit(Policy $policy)
    {
        return view('policies.edit', ['editable_policy'=>$policy]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Policy $policy)
    {
        try {
            $request->validate([
                'name'=>'required|string',
                'description'=>'nullable|string',
                'group'=>'required|string',
                'effective_date'=>'date|required',
            ]);
        } catch (\Throwable $th) {
            dd( $th );
        }
        
        $policy->name = $request->name;
        $policy->group = $request->group;
        $policy->effective_date = $request->effective_date;
        $policy->description = $request->description;

        $policy->save();
        return Redirect::back()->with('success', 'Changes have been saved Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Policy $policy)
    {
        //
    }
    public function download(Policy $policy)
    {
        $path=$policy->filepath;
        // dd($path);
        try {
            return Storage::download($path);
        } catch (\Throwable $th) {
            return Redirect::back()->with('error', 'File might have been deleted or moved');
        }
        
    }
}
