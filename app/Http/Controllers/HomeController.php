<?php

namespace App\Http\Controllers;

use App\Charts\CountryStatChart;
use App\Charts\EmployeesGenderChart;
use App\Models\Attendance;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Project;
use App\Models\Team;
use App\Models\Gender;
use App\Models\Leave;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(EmployeesGenderChart $chart, CountryStatChart $chart2)
    {
        // return view('home');
        $user=Auth::user();

        $data= [
            'clients'=>Client::all(),
            'projects'=>Project::all(),
            'employees'=>Employee::all(),
            'teams'=>Team::all(),
            'departments'=>Department::all(),

        ];
        if ($user->hasRole(['Admin', 'Super Admin','Operations Manager', 'Assistant Operations Manager', 'Business Development Manager',])) {
            $employees=Employee::all();
            $clients=Client::all();
            $contracts=Contract::all();
            $projects=Project::all();
            $departments=Department::all();
            $totalEmployees=Employee::count();
            $maleCount=Employee::where('gender_id',1)->count();
            $femaleCount=Employee::where('gender_id',2)->count();
            $otherCount=Gender::where('name','Other')->count();

            $malePercentage=($maleCount) ? ($maleCount/$totalEmployees)*100 : 0;
            $femalePercentage=($femaleCount) ? ($femaleCount/$totalEmployees)*100 : 0;
            $otherPercentage=($otherCount) ? ($otherCount/$totalEmployees)*100 : 0;
            $kenyanEmployees=Employee::where('country_id',110)->count();
            $ugandaEmployees=Employee::where('country_id',222)->count();
            $tanzaniaEmployees=Employee::where('country_id',210)->count();;
            $zambiaEmployees=Employee::where('country_id',238)->count();
            $malawiEmployees=Employee::where('country_id',128)->count();
            $ghanaEmployees=Employee::where('country_id',81)->count();
            $ethiopiaEmployees=Employee::where('country_id',68)->count();

            $pCount=Employee::where('contract_id',1)->count();
            $cCount=Employee::where('contract_id',2)->count();
            $csCount=Employee::where('contract_id',3)->count();
            $oJtCount=Employee::where('contract_id',4)->count();

            return view('dashboards.admin', ['chart' => $chart->build(), 'chart2' => $chart2->build()])
                ->with('malePercentage',$malePercentage)
                ->with('femalePercentage',$femalePercentage)
                ->with('otherPercentage',$otherPercentage)
                ->with('projects',$projects)
                ->with('pCount',$pCount)
                ->with('cCount',$cCount)
                ->with('csCount',$csCount)
                ->with('contracts', $contracts)
                ->with('oCount',$oJtCount)
                ->with('employees',$employees)
                ->with('kEmployees',$kenyanEmployees)
                ->with('uEmployees',$ugandaEmployees)
                ->with('tEmployees',$tanzaniaEmployees)
                ->with('zEmployees',$zambiaEmployees)
                ->with('mEmployees',$malawiEmployees)
                ->with('gEmployees',$ghanaEmployees)
                ->with('eEmployees',$ethiopiaEmployees)
                ->with('departments',$departments)
                ->with('clients',$clients);
        }
        else if ($user->hasRole('Software Developer')) {
            $employees=Employee::all();
            $clients=Client::all();
            $projects=Project::all();
            $departments=Department::all();
            $employee = Auth::user()->employee;
            // $user = User::where('employee_id', Auth::user()->employee->id))->get();
            // dd(Auth::user()->employee->id);
            return view('dashboards.software_dev')
                ->with('projects',$projects)
                ->with('departments',$departments)
                ->with('employees',$employees)
                ->with('employee', $employee)
                ->with('clients',$clients);            }
        // elseif($user->hasRole(['Operations Manager', 'Assistant Operations Manager'])){
        //     $employees=Employee::all();
        //     $clients=Client::all();
        //     $projects=Project::all();
        //     $departments=Department::all();
        //     return view('dashboards.manager')
        //         ->with('projects',$projects)
        //         ->with('departments',$departments)
        //         ->with('employees',$employees)
        //         ->with('clients',$clients);            }
        else if ($user->hasRole(['Human Resource Manager'])) {
            $clients = Client::paginate(10);
            $contracts = Contract::paginate(10);
            $projects = Project::paginate(10);
            $attendances = Attendance::all();
            $employees = Employee::all();
            $teams = Team::paginate(10);
            // dd($teams);
            $leaves = Leave::all();
            $departments = Department::paginate(10);
            return view('dashboards.hr', ['chart' => $chart->build()])
                ->with('projects', $projects)
                ->with('contracts', $contracts)
                ->with('leaves', $leaves)
                ->with('attendances', $attendances)
                ->with('departments', $departments)
                ->with('employees', $employees)
                ->with('clients', $clients)
                ->with('teams', $teams);
        } else if ($user->hasRole(['Human Resource Executive'])) {
            $clients = Client::all();
            $leaves = Leave::all();
            $attendances = Attendance::all();
            $projects = Project::all();
            $employees = Employee::all();
            $teams = Team::all();
            $departments = Department::all();
            return view('dashboards.hr', ['chart' => $chart->build()])
                ->with('projects', $projects)
                ->with('leaves', $leaves)
                ->with('attendances', $attendances)
                ->with('departments', $departments)
                ->with('employees', $employees)
                ->with('clients', $clients)
                ->with('teams', $teams);
        }
        elseif($user->hasRole(['Team Leader', 'Team Coordinator', 'Group Coordinator']))
        {
            // dd($a=Attendance::where('record_date', '>', date('Y-m-d'))->get());
            // dd(Carbon::create($a->record_date)->startOfMonth()->format('Y-d-m'));
            // $e=Employee::find(5)->GetAttendanceDuring(Carbon::now(), Carbon::now())->all();
            // dd(Employee::find(5)->attendances()->where('record_date','>', Carbon::now()->startOfDay())->get());
            // $e=Employee::find(1);
            // $ee=$e->getAttendanceDuring("2021-09-29", $a->record_date);
            // dd($ee->all());
            // $c=Attendance::where('status', '<>', 'present')
            //                 // ->where('created_at', '>', date('Y-m-d'))
            //                 ->distinct()
            //                 ->get();
            // dd($c);
            return view('dashboards.team_leader', [
                // 'members'=>Auth::user()->employee->teams_i_can_manage->map->members->first(),
                'members'=>Auth::user()->employee->teams_i_can_manage->flatMap->members,
                'leaves'=>Auth::user()->employee->leaves,
                'attendance'=>Auth::user()->employee->teams_i_can_manage->flatMap->attendance,
                'team'=>Auth::user()->employee->team,
            ]);
        }
        else if ($user->hasRole('Quality Coordinator')) {
            return view('dashboards.team_leader', [
            'members'=>Auth::user()->employee->teams_i_can_manage->flatMap->members,
            // 'members'=>Auth::user()->employee->teams_i_can_manage->map->members->first(),
            'leaves'=>Auth::user()->employee->leaves,
            'attendance'=>Auth::user()->employee->teams_i_can_manage->flatMap->attendance,
            'team'=>Auth::user()->employee->team,
        ]);
    }
        elseif($user->hasRole(['BPO Executive','IT Executive']))
        {
            // dd(Auth::user()->employee->getLeaveBalForYear(date('Y')));
            return view('dashboards.agent', [
                'leave_bal'=>Auth::user()->employee->leave_balances()->where('record_year', Carbon::now()->format('Y')),
                'members'=>Auth::user()->employee->team->members->where('id', '!=', Auth::user()->employee->id),
                'leaves'=>Auth::user()->employee->leaves,
                'attendance'=>Auth::user()->employee->team->attendance,
            ]);
        }

        else{
            abort(403, 'You are not authorised to access Opscore');
        }
    }

    public function showChangePasswordGet() {
        return view('auth.passwords.change-password');
    }

    public function changePasswordPost(Request $request) {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return back()->with("success","Password successfully changed!");
    }

    public function show ()
    {

    }
}
