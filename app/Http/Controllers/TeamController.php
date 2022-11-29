<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Employee;
use App\Models\TeamLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        $employees = Employee::all();
        $team_leads = TeamLead::all();
        return view('teams.index')->with('teams', $teams)->with('employees', $employees)->with('team_leads', $team_leads);
    }
    public function my_team()
    {
        return view('teams.', ['members' => Auth::user()->team->members, 'team' => Auth::user()->team]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('teams.create', ['employees'=>Employee::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'       => 'required',
            'description' => 'nullable'
         ]);
         $team             = new Team;
         $team->name       = $request->name;
         $team->description = $request->description;
         $team->save();

        TeamLead::create([
            'team_id'=>$team->id,
            'employee_id'=>$request->team_lead_id,
        ]);

		return redirect()->route('teams.index')->with('success', 'Team details Saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        // dd($team->id);
        if(Auth::user()->hasAnyRole(['Operations Manager','Administration Assistant','Admin','BPO Director','Head of Operations','Operations Manager','Quality Lead','Assistant Operations Manager','Business Development Executive','Administration Executive','Business Development Manager','Team Coordinator','Human Resource Manager'])){

            return view('teams.show', [
                'add_emp_to_team'=>Employee::where('team_id', '!=', $team->id)->orWhereNull('team_id')->get(),
                'add_teamlead_to_team'=>Employee::whereNotIn('id', $team->leads->pluck('employee_id')->toArray())->get(),
                'team'=>$team,
                'team_leads'=>TeamLead::all(),
                'teams'=>Team::all(),
                'members'=>$team->members,
            ]);
        }
        return abort(403, 'Unauthorized');
        // return view('teams.show',['members'=>Auth::user()->employee->team->members, 'team'=>$team]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('teams.edit', ['team'=>$team]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Team $team)
    {
        $team->update([
            'name'=>$request->name,
            'description'=>$request->description,
        ]);

        if($team){
            TeamLead::where('team_id', $team->id)->update(['employee_id'=>$request->team_lead_id]);
        };

		return redirect()->route('teams.index')->with('success', "{$team->name} details updated!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Team $team)
    {
        if($request->has('team_lead_id')){
        $team->leads()->first()->delete();
        }
        $team->delete();
        return back()->with('success', "Team has been deleted successfully!");
    }

    public function allocate_employees(Request $request, Team $team)
    {
        $request->validate([
            'employee_ids'=>'required|array',
        ]);
        foreach($request->employee_ids as $employee_id){
            Employee::findOrFail($employee_id)->update(['team_id'=>$team->id]);
        }
        return redirect()->route('teams.show', $team)->with('success', 'Employee(s) added successfully!');
    }
    public function allocate_team_leads(Request $request, Team $team){
        $request->validate([
            'employee_ids'=>'required|array',
        ]);
        try {
            //code...
            foreach($request->employee_ids as $employee_id){
                $team->leads()->create(['employee_id'=>$employee_id]);
            }
            return back()->with('success', "Team Lead added successfully to {$team->name}!");
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', "Sorry, we could not allocate a team lead to {$team->name}");
        }
    }
    public function re_allocate_employee(Employee $employee, Request $request)
    {

        $employee = Employee::findOrFail($request->employee_id);
        $employee->update(['team_id' => $request->new_team_id]);

        return back()->with('success', "Done! {$employee->name} has been re-allocated");
    }
}
