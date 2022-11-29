<?php

namespace App\Http\Controllers;

use App\Exports\LeavesExport;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\LeaveBalance;
use View;
use App\Models\Leave;
use App\Models\LeaveCategory;
use App\Models\Team;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Str;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // $leave = Leave::first();
        // dd($leave->employee_id);
        // dd($leave->employee->leave_balances()->where('record_year', now()->format('Y'))->where('leave_category_id', $leave->leave_category->id)->first()->balance);
        // dd($leave->employee->leave_balances()->where('record_year', now()->format('Y'))->where('leave_category_id', $leave->leave_category->id)->first()->balance);
        // return view('hrm.leaves.index', ['leaves'=> Leave::where('employee_id', Auth::user()->employee->id), 'cats'=>LeaveCategory::all()]);

        $user = Auth::user();
        $employee = $user->employee;
        $teams = $employee->teams_i_can_manage;
        $team = $teams->first();
        $members = ($team) ? $team->members : collect();
        $leaves=$members->flatMap->leaves;
        

        if($request->isMethod('post')){
            $request->validate([
                'flt_sap' => 'nullable',
                'flt_status' => 'nullable|string',
                'flt_leave_type_id' => 'nullable|string',
                'flt_team_id' => 'nullable|string',
                'flt_to'=>($request->flt_from) ? 'required|before_or_equal:today' : 'nullable|before_or_equal:today',
                'flt_from'=>($request->flt_to) ? 'required|before_or_equal:flt_to' : 'nullable|before_or_equal:flt_to',
            ]);
            if(isset($request->flt_team_id)){
                $team = Team::findOrFail($request->flt_team_id);
                $members = $team->members;
            }
            if(isset($request->flt_sap)){
                $members = Employee::where('sap', $request->flt_sap)->get();
            }
            $leaves=$members->flatMap->leaves;
        }
        #Managers
        if ($user->hasAnyRole([
            'Human Resource Manager',
            'Admin',
            'Operations Manager',
            'Head of Operations',
        ])) {
            if (Str::contains(Str::lower(Auth::user()->employee->gender->name), 'female')){
                $leave_categories =LeaveCategory::all()->except(5);

            } else{
                $leave_categories =LeaveCategory::all()->except(4);

            }
            return view('hrm.leaves.index_admin', [
                'leaves' => $leaves,
                'cats' => $leave_categories,
                'teams'=>Team::all()]);
        }

       #TL
       elseif ($employee->is_team_lead) {
        if($members->count() >= 10){
            $pCount = round(0.1*($members->count()));
        }
        else {
            $pCount = 1;
        }
        // dd('tl');
        // $leaves = Leave::with(['employee' => function ($query) {
        //     $query->where('report_to', Auth::user()->employee->id)->get();
        // }])->get();
        if (Str::contains(Str::lower(Auth::user()->employee->gender->name), 'female')){
            $leave_categories =LeaveCategory::all()->except(5);

        } else{
            $leave_categories =LeaveCategory::all()->except(4);

        }
        return view('hrm.leaves.index_admin', [
            'members'=>Auth::user()->employee->teams_i_can_manage->flatMap->members,
            'leaves' => $leaves,
            'pCount' =>$pCount,
            'cats' => $leave_categories,
            'teams'=>$teams,
        ]);
    }
        #employees
        else {
            if (Str::contains(Str::lower(Auth::user()->employee->gender->name), 'female')){
                $leave_categories =LeaveCategory::all()->except(5);

            } else{
                $leave_categories =LeaveCategory::all()->except(4);

            }
            return view('hrm.leaves.index', [
                'leaves' => Auth::user()->employee->leaves,
                'cats' => $leave_categories,
                'teams'=>$employee->team,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hrm.leaves.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Leave $leave)
    {
        $leave_days = explode(',', $request->leave_days);
        $max = Carbon::maxValue();
        $min = Carbon::minValue();
        for ($i = 0; $i < count($leave_days); $i++) {
            $leave_days[$i] = CarbonImmutable::make($leave_days[$i]);
            if ($i == 0) {
                $max = $leave_days[$i];
                $min = $leave_days[$i];
            } else {
                if ($leave_days[$i] < $min) {
                    $min = $leave_days[$i];
                }
                if ($leave_days[$i] > $max) {
                    $max = $leave_days[$i];
                }
            }
        }
        $num_days = count($leave_days);
        // dd($min);
        // dd($request->all());
        // dd("Minimum: {$min}, Maximum: {$max}");

        $rules = array(
            'leave_cat' => ['required', 'numeric', 'min:1'],
            // 'date_to'=>['required','string'],
            // 'date_from'=>['required','string'],
            'leave_days' => ['required', 'string'],
        );

        try {
            // $this->validate($request, array('date_to'=>'string'));
            $this->validate($request, $rules);
            // $request->validate($rules);
        } catch (\Throwable $th) {
            throw ($th);
        }
        // $bal=$employee->
        $leave_cat = LeaveCategory::findOrFail($request->leave_cat);
        $leave_bal = LeaveBalance::firstOrCreate(
            [
                'employee_id' => Auth::user()->employee->id,
                'leave_category_id' => $request->leave_cat,
                'record_year' => date('y'),
            ],
            [
                'consumed' => 0,
                'balance' => $leave_cat->num_days,
            ]
        );
        if ($leave_bal->balance >= $num_days) {
            $leave = Leave::create([
                'employee_id' => Auth::user()->employee->id,
                // 'end_date'=> Carbon::createFromFormat('d/m/Y', $request->date_to),
                // 'start_date'=> Carbon::createFromFormat('d/m/Y', $request->date_from),
                'end_date' => $max,
                'start_date' => $min,
                'leave_days' => json_encode(explode(',', $request->leave_days)),
                'reason' => $request->reason,
                'leave_category_id' => $request->leave_cat,
                'num_days' => $num_days,
                'status' => 'new',
                // ''=>$request->bal,
            ]);
            return Redirect::back()->with('success', 'Application has been submited successfully');
        } else {
            return Redirect::back()->with('error', 'You have insufficient leave balance');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        // $user = Auth::user();
        // $employee = $user->employee;
        // $my_leaves = $employee->leaves;
        dd($leave);
        // return view('hrm.leaves.show', ['leave', $leave]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        return view('hrm.leaves.edit', ['leave', $leave]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $leave = Leave::find($id);
        //
        $data = $request->all();
        // $leave->start_date=$min;
        // $leave->end_date=$max;
        // $leave->leave_days=$request->leave_days;
        $leave->num_days = $request->num_days;
        $leave->reason = $request->reason;
        $leave->leave_category_id = $request->leave_cat;
        $leave->employee_id = $request->employee_id;

        $leave->save();

        return redirect()->route('leaves.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy( $leave)
    {
        try {
            Leave::findOrFail($leave)->delete();
            return back()->with('success', 'Leave deleted successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Unable to delete leave');
        }
    }
    public function approve(Request $request, Leave $leave)
    {
        $request->validate([
            // 'leave_id'=>['numeric','required'],
            'new_status' => ['string', 'required'],
            'comments' => ['string', 'required']
        ]);

        $leave_bal = LeaveBalance::firstOrCreate(
            [
                'employee_id' => $leave->employee->id,
                'leave_category_id' => $leave->leave_category->id,
                'record_year' => date('Y'),
            ],
            [
                'consumed' => 0,
                'balance' => $leave->leave_category->num_days,
            ]
        );
        if ($leave_bal->balance - $leave->num_days >= 0) {
            if($request->new_status === 'Approved'){
            $leave_bal->update([
                'consumed' => $leave_bal->consumed + $leave->num_days,
                'balance' => $leave_bal->balance - $leave->num_days,
            ]);
            $attendance = Attendance::updateOrCreate(
                [
                    'record_date' => date('Y-m-d'),
                    'employee_id' => $leave->employee_id,
                ],
                [
                    'status' => $leave->leave_category->name,
                    'comments' =>"Approved {$leave->leave_category->name}",
                    'team_leader' => Auth::user()->employee->id,
                ]
            );
        }
        } else {
            return back()->with('error', 'Insufficient leave balance');
        }

        if ($leave->employee->id <> Auth::user()->employee_id) {
            $leave->status = $request->new_status;
            $leave->comments = $request->comments;
            if ($request->new_status == 'Approved') {
                $leave->approved_by_id = Auth::user()->id;
            }
            $leave->save();
            return Redirect::back()->with('success', "Leave has been updated");
        } else {
            return Redirect::back()->with('error', "Well...You can't approve your own leave!");
        }
    }
    public function export()
    {
        return Excel::download(new LeavesExport, 'leaves.xlsx');
    }
    public function leaveStatistics(Employee $employee)
    {
        if (Str::contains(Str::lower(Auth::user()->employee->gender->name), 'female')){
            $leave_categories =LeaveCategory::all()->except(5);

        } else{
            $leave_categories =LeaveCategory::all()->except(4);

        }


        return view('hrm.leaves.leave_statistics', ['employee' => $employee, 'leave_categories' => $leave_categories]);
    }
    public function leaveStatEdit(Request $request)
    {
        $request->validate([
            'carried_forward' => 'nullable|numeric',
            'balance' => 'required|numeric',
            'employee_id' => 'required|numeric',
            'leave_category_id' => 'required|numeric'
        ]);
        $bal = new LeaveBalance;
        try {
            $bal = LeaveBalance::findOrFail($request->bal_id);
        } catch (\Throwable $th) {
            $bal = LeaveBalance::firstOrCreate(
                [
                    'employee_id' => $request->employee_id,
                    'leave_category_id' => $request->leave_category_id,
                    'record_year' => date('Y'),
                ],
                [
                    // 'carried_forward' => 0,
                    'consumed' => 0,
                    'balance' => LeaveCategory::findOrFail($request->leave_category_id)->num_days,
                ]
            );
        }
        $bal->update([
            'balance' => $request->balance,
        ]);
        if (isset($request->carried_forward)) {
            $bal->update([
                'carried_forward' => $request->carried_forward,
            ]);
        };
        return back()->with('success', "Leave balance updated successfully!");
    }
    public function my_leave_applications ()
    {
        $employee = Auth::user()->employee;
        $leaves = $employee->leaves;
        return view('hrm.leaves.show', ['employee'=>$employee,'leaves'=>$leaves]);
    }

}
