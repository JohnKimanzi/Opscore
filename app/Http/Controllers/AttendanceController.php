<?php

namespace App\Http\Controllers;

use App\Charts\LeavesOnMonthAttendanceChart;
use App\Exports\AttendancesExport;
use App\Models\Attendance;
use App\Models\Employee;
use App\Imports\AttendancesImport;
use App\Models\Project;
use App\Models\Team;
use App\Models\TeamLead;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use DateTime;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $teams = $user->employee->teams_i_can_manage;
        $employees = $teams->flatMap->members;
        if ($user->hasAnyRole([
            'Human Resource Manager',
            'Admin',
            'Operations Manager',
            'Head of Operations',
            'Quality Lead'

        ])) {
            $teams = Team::all();
            $projects = Project::all();
        }

        // $team = $teams->first();
        // $employees = $team->members;
        if ($request->isMethod('post')) {
            $request->validate([
                'flt_to' => ($request->flt_from) ? 'required|before_or_equal:today' : 'nullable|before_or_equal:today',
                'flt_from' => ($request->flt_to) ? 'required|before_or_equal:flt_to' : 'nullable|before_or_equal:flt_to',
            ]);

            try {
                $project = Project::findOrfail($request->flt_project_id);
                // dd($project);
            } catch (\Throwable $th) {
                $project = $user->employee->project;
            }

            try {
                $team = Team::findOrfail($request->flt_team_id);
                // dd($team);
            } catch (\Throwable $th) {
                $team = $user->employee->teams_i_can_manage->first();
            }
            if (isset($request->flt_project_id)) {
                $employees = $project->employees;
            } else {
                $employees = $team->members;
            }
            if (isset($request->flt_sap)) {
                // dd('');
                $employees = Employee::where('sap', $request->flt_sap);
            }
        }
        $start_date = isset($request->flt_from) ? Carbon::make($request->flt_from) : Carbon::now()->subDays(7);
        $end_date = isset($request->flt_to) ? Carbon::make($request->flt_to) : Carbon::now();

        // dd($start_date);

        $period = CarbonPeriod::create($start_date, $end_date);

        #TL's view for marking attendance
        if ($user->employee->is_team_lead) {
            // dd($team);
            return view('hrm.attendance.index-admin', [
                'attendance' => $employees->map->attendances,
                'employees' => $employees,
                'period' => $period,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'teams' => $teams,
            ]);
        }

        #Admin's per team view.
        elseif ($user->hasAnyRole([
            'Human Resource Manager',
            'Admin',
            'Operations Manager',
            'Head of Operations',
            'Quality Lead'
        ])) {
            return view('hrm.attendance.index-admin', [
                'attendance' => $employees->flatMap->attendances,
                'employees' => $employees,
                'period' => $period,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'teams' => $teams,
                'projects' => Project::all()
            ]);
        }

        #common employee
        else {

            $employees = Employee::whereIn('id', [$user->employee->id])->get();
            return view('hrm.attendance.index-employee', [
                'attendance' => $user->employee->attendances,
                'employees' => [$user->employee],
                'period' => $period,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'teams' => $teams,
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
        $user = Auth::user();
        if ($request->employee_id == $user->id) {
            return back()->with('error', 'You can not mark your own attendance');
        }
        //dd('Validating ...');
        $this->check_permission('Manage Attendance');
        $rules = array(
            'record_date' => 'required|date|before:tomorrow',
            'status' => 'required|string',
            'comments' => 'nullable|string',
            'employee_id' => 'required|numeric|min:0',
        );
        $this->validate($request, $rules);

        $checkIfExist = Attendance::where('record_date', new Carbon($request->record_date))->where('employee_id', $request->employee_id)->where('status', $request->status)->first();

        if ($checkIfExist) {
            return Redirect::back()->with('warning', "No changes made");
        }


        //if (Auth::user()->hasRole('Admin')    )
        if ($user->employee->id == Employee::find($request->employee_id)->report_to) //Check if logged in user is employee's supervisor
        {
            $attendance = Attendance::updateOrCreate(
                [
                    'record_date' => new Carbon($request->record_date),
                    'employee_id' => $request->employee_id,
                ],
                [
                    'status' => $request->status,
                    'comments' => $request->comments,
                    'team_leader' => $user->employee->id,
                ]
            );
        } else {

            //cannot mark attendance, only those with  Hr manager , operations manager and team cordinator can

            if (
                $user->hasRole('Human Resource Manager') ||
                $user->hasRole('Operations Manager') ||
                $user->hasRole('Team Coordinator') ||
                $user->hasRole('Head of Operations') ||
                $user->hasRole('Admin')
            ) // Replace all these with 'permission = can manage attendances'
            {
                $attendance = Attendance::updateOrCreate(
                    [
                        'record_date' => new Carbon($request->record_date),
                        'employee_id' => $request->employee_id,
                    ],
                    [
                        'status' => $request->status,
                        'comments' => $request->comments,
                        'team_leader' => $user->employee->id,
                    ]
                );
            }
        }
        // Session::flash('success', "Updated");

        return back()->with('success', "Register has been updated");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    /**
     * Return a subset of attendances.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function filter(Request $request)
    {
        // $datess= Carbon::CreateFromFormat('m-Y', $request->flt_year.'-'.$request->flt_year);
        $employees = null;
        $employees = Employee::where('sap', $request->flt_sap);

        if (isset($request->flt_sap)) {
            $employees = Employee::where('sap', $request->flt_sap)->get();
            if ($employees == null)
                return Redirect::back()->with('error', 'Oops! Employee not found. Check the SAP ID and try again');
        } else {
            // dd($request->flt_sap);
            $employees = Employee::all();
        }
        $start_date = new Carbon($request->flt_from);
        $end_date = new Carbon($request->flt_to);
        if (!$start_date->lte($end_date)) {
            return Redirect::back()->with('error', 'Oops! Invalid date range. Check your input and try again');
        }
        // dd($employees);
        return view('hrm.attendance.index-admin', ['employees' => $employees, 'start_date' => $start_date, 'end_date' => $end_date, 'projects' => Project::all()]);
    }
    // public function export()
    // {
    //     return Excel::download(new AttendancesExport, 'Attendances.xlsx');
    // }
    public function export() {
        return Excel::download(
            new AttendancesExport(),
            'attendances.xlsx'
        );
    }
    public function import(Request $request)
    {
        $temp_path = $request->file('file_to_import')->store('temp');
        $path = storage_path('app') . '/' . $temp_path;
        $data = Excel::import(new AttendancesImport, $path);
        return redirect::back()->with('success', 'All records have been uploaded. All good!');
    }
    public function download_template()
    {
        return response()->download(storage_path('app/public/templates/opscore_attendance_upload_template.xlsx'));
        // return Storage::download('public/templates/opscore_attendance_upload_template.xlsx');
    }

    public function chartjs()
    {
        $today = Carbon::today();
        $dates = [];

        for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
            $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');

            $presentCount = [];
            $absentCount = [];
            $annualLeaveCount = [];

            foreach ($dates as $date) {
                $presentCount[] = Auth::user()->employee->teams_i_can_manage->flatMap->members->flatMap->attendances->where('record_date', '=', $date)->where('status', 'present')->pluck('record_date')->count();
                $absentCount[] = Auth::user()->employee->teams_i_can_manage->flatMap->members->flatMap->attendances->where('record_date', '=', $date)->where('status', 'absent')->pluck('record_date')->count();
                $annualLeaveCount[] = Auth::user()->employee->teams_i_can_manage->flatMap->members->flatMap->leaves->where('leave_category_id', 1)->where('status', 'Approved')->where('end_date', '>', $date)->pluck('leave_days')->count();

            }
        }
        return view('charts.chartjs', compact('dates','presentCount', 'absentCount', 'annualLeaveCount'));
    }

    public function chartLastMonth()
    {
        //get the previous month
        $previous = Carbon::now()->subMonth();
        $dates = [];

        for ($i = 1; $i < $previous->daysInMonth + 1; ++$i) {
            $dates[] = \Carbon\Carbon::createFromDate($previous->year, $previous->month, $i)->format('Y-m-d');

            $presentPreviousMonth = [];
            $absentPreviousMonth = [];
            $annualLeavePreviousMonth = [];

            foreach ($dates as $date) {
                $presentPreviousMonth[] = Auth::user()->employee->teams_i_can_manage->flatMap->members->flatMap->attendances->where('record_date', '=', $date)->where('status', 'present')->pluck('record_date')->count();
                $absentPreviousMonth[] = Auth::user()->employee->teams_i_can_manage->flatMap->members->flatMap->attendances->where('record_date', '=', $date)->where('status', 'absent')->pluck('record_date')->count();
                $annualLeavePreviousMonth[] = Auth::user()->employee->teams_i_can_manage->flatMap->members->flatMap->leaves->where('leave_category_id', 1)->where('status', 'Approved')->where('start_date', '<=', Carbon::now()->subMonths(1)->endOfMonth())->where('end_date', '>=', $date)->pluck('leave_days')->count();

            }
        }
        return view('charts.chart_last_month', compact('dates','presentPreviousMonth', 'absentPreviousMonth', 'annualLeavePreviousMonth'));
    }
    public function adminChart(int $id)
    {
        $team = Team::findOrFail($id);
        // dd($team);
        $today = Carbon::today();
        $dates = [];

        for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
            $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');

            $presentCount = [];
            $absentCount = [];
            $annualLeaveCount = [];

            foreach ($dates as $date) {
                $presentCount[] = $team->members->flatMap->attendances->where('record_date', '=', $date)->where('status', 'present')->pluck('record_date')->count();
            //   dd($presentCount);
                $absentCount[] = $team->members->flatMap->attendances->where('record_date', '=', $date)->where('status', 'absent')->pluck('record_date')->count();
                $annualLeaveCount[] = $team->members->flatMap->leaves->where('leave_category_id', 1)->where('status', 'Approved')->where('end_date', '>', $date)->pluck('leave_days')->count();

            }
        }
        return view('charts.adminChart', [
            'team'=>$team,
            'dates'=>$dates,
            'presentCount'=>$presentCount,
            'absentCount'=>$absentCount,
            'annualLeaveCount'=>$annualLeaveCount
        ]);
    }
    public function adminChartLastMonth(int $id)
    {
        $team = Team::findOrFail($id);
        // dd($team->id);
        //get the previous month
        $previous = Carbon::now()->subMonth();
        $dates = [];

        for ($i = 1; $i < $previous->daysInMonth + 1; ++$i) {
            $dates[] = \Carbon\Carbon::createFromDate($previous->year, $previous->month, $i)->format('Y-m-d');

            $presentPreviousMonth = [];
            $absentPreviousMonth = [];
            $annualLeavePreviousMonth = [];

            foreach ($dates as $date) {
                $presentPreviousMonth[] = $team->members->flatMap->attendances->where('record_date', '=', $date)->where('status', 'present')->pluck('record_date')->count();
                $absentPreviousMonth[] = $team->members->flatMap->attendances->where('record_date', '=', $date)->where('status', 'absent')->pluck('record_date')->count();
                $annualLeavePreviousMonth[] = $team->members->flatMap->leaves->where('leave_category_id', 1)->where('status', 'Approved')->where('start_date', '<=', Carbon::now()->subMonths(1)->endOfMonth())->where('end_date', '>', $date)->pluck('leave_days')->count();

            }
        }
        return view('charts.admin_chart_last_month', [
            'team' => $team,
            'dates' => $dates,
            'presentPreviousMonth'=>$presentPreviousMonth,
            'absentPreviousMonth'=>$absentPreviousMonth,
            'annualLeavePreviousMonth'=>$annualLeavePreviousMonth
        ]);
    }
    public function allAttendance()
    {
        $employee = Employee::all();
        $today = Carbon::today();
        $dates = [];

        for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
            $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');

            $presentCount = [];
            $absentCount = [];
            $annualLeaveCount = [];

            foreach ($dates as $date) {
                $presentCount[] = $employee->flatMap->attendances->where('record_date', '=', $date)->where('status', 'present')->pluck('record_date')->count();
                $absentCount[] = $employee->flatMap->attendances->where('record_date', '=', $date)->where('status', 'absent')->pluck('record_date')->count();
                $annualLeaveCount[] = $employee->flatMap->leaves->where('leave_category_id', 1)->where('end_date', '>', $date)->pluck('leave_days')->count();

            }
        }
        return view('charts.all_attendance', compact('dates','presentCount', 'absentCount', 'annualLeaveCount'));
    }
    public function allAttendanceLastMonth()
    {
        //get the previous month
        $employees = Employee::all();
        $previous = Carbon::now()->subMonth();
        $dates = [];

        for ($i = 1; $i < $previous->daysInMonth + 1; ++$i) {
            $dates[] = \Carbon\Carbon::createFromDate($previous->year, $previous->month, $i)->format('Y-m-d');

            $presentPreviousMonth = [];
            $absentPreviousMonth = [];
            $annualLeavePreviousMonth = [];

            foreach ($dates as $date) {
                $presentPreviousMonth[] = $employees->flatMap->attendances->where('record_date', '=', $date)->where('status', 'present')->pluck('record_date')->count();
                $absentPreviousMonth[] = $employees->flatMap->attendances->where('record_date', '=', $date)->where('status', 'absent')->pluck('record_date')->count();
                $annualLeavePreviousMonth[] = $employees->flatMap->leaves->where('leave_category_id', 1)->where('status', 'Approved')->where('start_date', '<=', Carbon::now()->subMonths(1)->endOfMonth())->where('end_date', '<', $date)->pluck('leave_days')->count();

            }
        }
        return view('charts.all_attendance_last_month', compact('dates','presentPreviousMonth', 'absentPreviousMonth', 'annualLeavePreviousMonth'));
    }
}
