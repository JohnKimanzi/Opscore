<?php

namespace App\Http\Controllers;

use App\Models\ProjectType;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasAnyRole('Operations Manager|Admin|BPO Director|Head of Operations|Operations Manager|Human Resouce Manager|Human Resouce Executive')){
            $types=ProjectType::all();

            return  view('project_type.index')->with('types',$types);
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

        $type=ProjectType::create([
            'name'=>$name
        ]);

        if ($type){
            return  redirect()->route('project_type.index')->with('success','Project type created successfully');
        }
        return  redirect()->route('project_type.index')->with('error','Project type not created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectType $projectType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectType $projectType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ProjectType $projectType)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $name=$request->input('name');

        $projectType->name=$name;

        if ($projectType->save()){
            return  redirect()->route('project_type.index')->with('success','Project type updated successfully');
        }
        return  redirect()->route('project_type.index')->with('error','Project type not updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ProjectType $projectType)
    {
        if ($projectType->delete()){
            return  redirect()->route('project_type.index')->with('success','Project type deleted successfully');

        }
        return  redirect()->route('project_type.index')->with('error','Project type not deleted');
    }
}
