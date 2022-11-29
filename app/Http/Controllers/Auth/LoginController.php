<?php

namespace App\Http\Controllers\Auth;

use App\Charts\CountryStatChart;
use App\Charts\EmployeesGenderChart;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Client;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Project;
use App\Models\Team;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contract;
use App\Models\Leave;
use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    use HasRoles;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public  function  loginUser(Request  $request, EmployeesGenderChart $chart, CountryStatChart $chart2)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $data = [
                'clients' => Client::all(),
                'projects' => Project::all(),
                'employees' => Employee::all(),
                'teams' => Team::all(),
                'departments' => Department::all(),
                'contracts' => Contract::all(),
            ];
            if ($user->hasRole(['Admin', 'Super Admin', 'Operations Manager', 'Assistant Operations Manager', 'Business Development Manager',])) {
                $employees = Employee::all();
                $clients = Client::all();
                $contracts = Contract::all();
                $projects = Project::all();
                $departments = Department::all();
                $totalEmployees = Employee::count();
                $maleCount = Employee::where('gender_id', 1)->count();
                $femaleCount = Employee::where('gender_id', 2)->count();

                $malePercentage = ($maleCount) ? ($maleCount / $totalEmployees) * 100 : 0;
                $femalePercentage = ($femaleCount) ? ($femaleCount / $totalEmployees) * 100 : 0;
                $kenyanEmployees = Employee::where('country_id', 110)->count();
                $ugandaEmployees = Employee::where('country_id', 222)->count();
                $tanzaniaEmployees = Employee::where('country_id', 210)->count();;
                $zambiaEmployees = Employee::where('country_id', 238)->count();
                $malawiEmployees = Employee::where('country_id', 128)->count();
                $ghanaEmployees = Employee::where('country_id', 81)->count();
                $ethiopiaEmployees = Employee::where('country_id', 68)->count();

                $pCount = Employee::where('contract_id', 1)->count();
                $cCount = Employee::where('contract_id', 2)->count();
                $csCount = Employee::where('contract_id', 3)->count();
                $oJtCount = Employee::where('contract_id', 4)->count();

                return view('dashboards.admin', ['chart' => $chart->build(), 'chart2' => $chart2->build()])
                    ->with('malePercentage', $malePercentage)
                    ->with('femalePercentage', $femalePercentage)
                    ->with('projects', $projects)
                    ->with('pCount', $pCount)
                    ->with('cCount', $cCount)
                    ->with('csCount', $csCount)
                    ->with('contracts', $contracts)
                    ->with('oCount', $oJtCount)
                    ->with('employees', $employees)
                    ->with('kEmployees', $kenyanEmployees)
                    ->with('uEmployees', $ugandaEmployees)
                    ->with('tEmployees', $tanzaniaEmployees)
                    ->with('zEmployees', $zambiaEmployees)
                    ->with('mEmployees', $malawiEmployees)
                    ->with('gEmployees', $ghanaEmployees)
                    ->with('eEmployees', $ethiopiaEmployees)
                    ->with('departments', $departments)
                    ->with('clients', $clients);
            } else if ($user->hasRole('Software Developer')) {
                $employees = Employee::all();
                $clients = Client::all();
                $projects = Project::all();
                $departments = Department::all();
                return view('dashboards.admin', ['chart' => $chart->build()])
                    ->with('projects', $projects)
                    ->with('departments', $departments)
                    ->with('employees', $employees)
                    ->with('clients', $clients);
            } else if ($user->hasRole('Trainer')) {
                $employees = Employee::all();
                $clients = Client::all();
                $projects = Project::all();
                $departments = Department::all();
                return view('dashboards.admin')
                    ->with('projects', $projects)
                    ->with('departments', $departments)
                    ->with('employees', $employees)
                    ->with('clients', $clients);
            } else if ($user->hasRole('Agent')) {
                // $employees=Employee::all();
                $clients = Client::all();
                $projects = Project::all();
                $departments = Department::all();
                return view('dashboards.agent')
                    ->with('projects', $projects)
                    ->with('departments', $departments)
                    // ->with('employees',$employees)
                    ->with('clients', $clients);
            } else if ($user->hasRole('Head of Operations')) {
                $employees = Employee::all();
                $clients = Client::all();
                $projects = Project::all();
                $departments = Department::all();
                return view('dashboards.manager', ['chart' => $chart->build()])
                    ->with('projects', $projects)
                    ->with('departments', $departments)
                    ->with('employees', $employees)
                    ->with('clients', $clients);
            } elseif ($user->hasRole(['Operations Manager', 'Assistant Operations Manager'])) {
                $employees = Employee::all();
                $clients = Client::all();
                $projects = Project::all();
                $departments = Department::all();
                return view('dashboards.manager', ['chart' => $chart->build()])
                    ->with('projects', $projects)
                    ->with('departments', $departments)
                    ->with('employees', $employees)
                    ->with('clients', $clients);
            } else if ($user->hasRole(['Team Leader', 'Team Coordinator', 'Group Coordinator', 'Quality Coordinator'])) {
                return view('dashboards.team_leader', [
                    'members' => Auth::user()->employee->teams_i_can_manage->flatMap->members,
                    // 'members'=>Auth::user()->employee->teams_i_can_manage->map->members->first(),
                    'leaves' => Auth::user()->employee->leaves,
                    'attendance' => Auth::user()->employee->teams_i_can_manage->flatMap->attendance,
                    'team' => Auth::user()->employee->team,
                    'chart' => $chart->build()
                ]);
            } else if ($user->hasRole('Quality Coordinator')) {
                return view('dashboards.team_leader', [
                    'members' => Auth::user()->employee->teams_i_can_manage->flatMap->members,
                    // 'members'=>Auth::user()->employee->teams_i_can_manage->map->members->first(),
                    'leaves' => Auth::user()->employee->leaves,
                    'attendance' => Auth::user()->employee->teams_i_can_manage->flatMap->attendance,
                    'team' => Auth::user()->employee->team,
                    'chart' => $chart->build()

                ]);
            } else if ($user->hasRole('Workforce Manager')) {
                $employees = Employee::all();
                $clients = Client::all();
                $projects = Project::all();
                $departments = Department::all();
                return view('dashboards.admin', ['chart' => $chart->build()])
                    ->with('projects', $projects)
                    ->with('departments', $departments)
                    ->with('employees', $employees)
                    ->with('clients', $clients);
            } else if ($user->hasRole('Management Information Systems Executive')) {
                $employees = Employee::all();
                $clients = Client::all();
                $projects = Project::all();
                $departments = Department::all();
                return view('dashboards.admin', ['chart' => $chart->build()])
                    ->with('projects', $projects)
                    ->with('departments', $departments)
                    ->with('employees', $employees)
                    ->with('clients', $clients);
            } else if ($user->hasRole('Senior Information Technology Executive')) {
                $employees = Employee::all();
                $clients = Client::all();
                $projects = Project::all();
                $departments = Department::all();
                return view('dashboards.admin', ['chart' => $chart->build()])
                    ->with('projects', $projects)
                    ->with('departments', $departments)
                    ->with('employees', $employees)
                    ->with('clients', $clients);
            } else if ($user->hasRole('IT Manager')) {
                $employees = Employee::all();
                $clients = Client::all();
                $projects = Project::all();
                $departments = Department::all();
                return view('dashboards.admin', ['chart' => $chart->build()])
                    ->with('projects', $projects)
                    ->with('departments', $departments)
                    ->with('employees', $employees)
                    ->with('clients', $clients);
            } else if ($user->hasRole('Business Development Manager')) {
                $employees = Employee::all();
                $clients = Client::all();
                $projects = Project::all();
                $departments = Department::all();
                return view('dashboards.admin', ['chart' => $chart->build()])
                    ->with('projects', $projects)
                    ->with('departments', $departments)
                    ->with('employees', $employees)
                    ->with('clients', $clients);
            } else if ($user->hasRole('Business Development Executive')) {
                $employees = Employee::all();
                $clients = Client::all();
                $projects = Project::all();
                $departments = Department::all();
                return view('dashboards.admin', ['chart' => $chart->build()])
                    ->with('projects', $projects)
                    ->with('departments', $departments)
                    ->with('employees', $employees)
                    ->with('clients', $clients);
            } else if ($user->hasRole('Presales Executive')) {
                $employees = Employee::all();
                $clients = Client::all();
                $projects = Project::all();
                $departments = Department::all();
                return view('dashboards.admin', ['chart' => $chart->build()])
                    ->with('projects', $projects)
                    ->with('departments', $departments)
                    ->with('employees', $employees)
                    ->with('clients', $clients);
            } else if ($user->hasRole('Administration Executive')) {
                $employees = Employee::all();
                $clients = Client::all();
                $projects = Project::all();
                $departments = Department::all();
                return view('dashboards.admin', ['chart' => $chart->build()])
                    ->with('projects', $projects)
                    ->with('departments', $departments)
                    ->with('employees', $employees)
                    ->with('clients', $clients);
            }     else if ($user->hasRole(['Human Resource Manager'])) {
                $clients = Client::paginate(10);
                $projects = Project::paginate(10);
                $attendances = Attendance::all();
                $employees = Employee::all();
                $teams = Team::paginate(10);
                $contracts = Contract::paginate(10);
                $leaves = Leave::all();
                $departments = Department::all();
                return view('dashboards.hr', ['chart' => $chart->build()])
                    ->with('projects', $projects)
                    ->with('leaves', $leaves)
                    ->with('contracts', $contracts)
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
                    ->with('attendances', $attendances)
                    ->with('leaves', $leaves)
                    ->with('departments', $departments)
                    ->with('employees', $employees)
                    ->with('clients', $clients)
                    ->with('teams', $teams);
            } elseif($user->hasRole(['BPO Executive','IT Executive']))
            {
                // dd(Auth::user()->employee->getLeaveBalForYear(date('Y')));
                return view('dashboards.agent', [
                    'leave_bal'=>Auth::user()->employee->leave_balances()->where('record_year', Carbon::now()->format('Y')),
                    'members'=>Auth::user()->employee->team->members->where('id', '!=', Auth::user()->employee->id),
                    'leaves'=>Auth::user()->employee->leaves,
                    'attendance'=>Auth::user()->employee->team->attendance,
                ]);
            }
        } else {

            return  redirect()->back()->withErrors([
                'message' => 'Invalid email or password'
            ]);
        }
    }
}
