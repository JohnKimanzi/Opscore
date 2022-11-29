<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use App\Imports\EmployeesImport;
use App\Imports\TestImport;
use App\Mail\UserCreated;
use App\Models\BloodGroup;
use App\Models\Contract;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Department;
use App\Models\Designation;
use App\Models\DisabilityStatus;
use App\Models\EducationLevel;
use App\Models\Employee;
use App\Models\EmployeeEducation;
use App\Models\EmployeeExperience;
use App\Models\EmployeeMedicalCondition;
use App\Models\EmployeeStatus;
use App\Models\Gender;
use App\Models\HealthStatus;
use App\Models\Language;
use App\Models\EmployeeLanguage;
use App\Models\MaritalStatus;
use App\Models\NextOfKin;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;

class EmployeeController extends Controller
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
        if ($request->has('view_deleted')) {
            $employees = Employee::onlyTrashed()->get();
        } else $employees = Employee::all();
        return view('hrm.employees.index', [
            'employees' => $employees,
        ]);
        $this->check_permission('Manage Employees');

        if (auth()->user()->hasRole('Team Leader')) {
            // return abort(403, 'Unauthorized');
            $employees = Employee::where('team_id', Auth::user()->employee->team->id)->get();
            return view('hrm.employees.index', ['employees' => $employees]);
        } elseif (Auth::user()->hasAnyRole('Human Resource Manager|Admin|BPO Director|Head of Operations|Operations Manager|Human Resouce Manager|Human Resouce Executive')) {
            return view('hrm.employees.index', ['employees' =>
            Employee::with('department')->with('project')->with('designation')->with('team')->with('currency')->get()]);
        }

        return abort(403, 'Unauthorized');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::where('designation_id', '!=', 13)
            ->where('designation_id', '!=', 22)
            ->where('designation_id', '!=', 13)
            ->where('designation_id', '!=', 14)
            ->get();
        $genders = Gender::all();
        $currencies = Currency::all();
        $marital_statuses = MaritalStatus::all();
        $countries = Country::all();
        $statuses = EmployeeStatus::all();
        $contract_types = Contract::all();
        $departments = Department::all();
        $designation = Designation::all();
        $teams = Team::all();
        $projects = Project::where('status_id', 1)->get();
        $blood_groups = BloodGroup::all();
        $disabilityStatus = DisabilityStatus::all();
        $healthStatus = HealthStatus::all();
        $languages = Language::all();
        $educationLevels = EducationLevel::all();

        if (Auth::user()->hasAnyRole('Human Resource Manager|Admin|BPO Director|Head of Operations|Operations Manager|Human Resouce Manager|Human Resouce Executive')) {

            return view('hrm.employees.create')
                ->with('countries', $countries)
                ->with('employees', $employees)
                ->with('statuses', $statuses)
                ->with('education_levels', $educationLevels)
                ->with('departments', $departments)
                ->with('blood_groups', $blood_groups)
                ->with('disability', $disabilityStatus)
                ->with('health', $healthStatus)
                ->with('projects', $projects)
                ->with('teams', $teams)
                ->with('designations', $designation)
                ->with('languages', $languages)
                ->with('contract_types', $contract_types)
                ->with('genders', $genders)
                ->with('marital_statuses', $marital_statuses)
                ->with('currencies', $currencies);
        }


        return abort(403, 'Unauthorized');
    }

    /**
     * Store a newly created resource in storage.<
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //validate

        $rules = array(
            'sap' => ['required', 'string', 'unique:employees'],
            'f_name' => ['required', 'string'],
            'm_name' => ['required', 'string'],
            'l_name' => ['required', 'string'],
            'dob' => ['required', 'date'],
            'currency_id' => ['required', 'string'],
            'gender_id' => ['required', 'string'],
            'country_id' => ['required', 'string'],
            'marital_status_id' => ['required', 'string'],

            'phone1' => ['required', 'string'],
            'work_email' => ['nullable', 'string'],
            'personal_email' => ['required', 'string'],
            'residence' => ['required', 'string'],
            'permanent_address' => ['required', 'string'],

            'contract_id' => ['required'],
            'contract_expiry' => ['required', 'date', 'after:today'],
            'contract_start' => ['required', 'date', 'before:contract_expiry'],
            'department_id' => ['required', 'numeric'],
            'designation_id' => ['required', 'string'],
            'project_id' => ['nullable', 'string'],
            'team_id' => ['required', 'string'],

            'national_id' => ['required', 'string'],
            'kra_pin' => ['required', 'string'],
            'nssf' => ['required', 'string'],
            'nhif' => ['required', 'string'],


            'bank_name' => ['required', 'string'],
            'branch_code' => ['required', 'string'],
            'bank_branch' => ['required', 'string'],
            'account_name' => ['required', 'string'],
            'account_number' => ['required', 'string'],

            //medical
            'blood_group' => ['nullable'],
            'disability' => ['required'],

            'medical_condition' => ['required'],

            //Next of kin
            'nextOfKin' => ['required'],

            // Education
            'educationDetails' => ['required'],

        );

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return  response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        } else {
                $employee = Employee::create([
                    'sap' => $request->filled('sap') ? $request->sap : Str::random(5),
                    'first_name' => ucfirst($request->f_name),
                    'middle_name' => ucfirst($request->m_name),
                    'last_name' => ucfirst($request->l_name),
                    'dob' => $request->dob,
                    'gender_id' => $request->gender_id,
                    'country_id' => $request->country_id,
                    'marital_status_id' => $request->marital_status_id,

                    'phone1' => $request->phone1,
                    'phone2' => $request->phone2,
                    'work_email' => $request->work_email,
                    'personal_email' => $request->personal_email,
                    // 'personal_email2'=>$request->personal_email2,
                    'residence' => ucfirst($request->residence),
                    'permanent_address' => ucfirst($request->permanent_address),

                    'contract_id' => $request->contract_id,
                    'basic_salary'=>$request->basic_salary,
                    'contract_start' => $request->contract_start,
                    'contract_expiry' => $request->contract_expiry,
                    'department_id' => $request->department_id,
                    'currency_id' => $request->currency_id,
                    'designation_id' => $request->designation_id,
                    'project_id' => $request->project_id,
                    'team_id' => $request->team_id,

                    'passport_number' => '',
                    'national_id' => $request->national_id,
                    'kra_pin' => $request->kra_pin,
                    'nssf' => $request->nssf,
                    'nhif' => $request->nhif,
                    'huduma_number' => '',


                    'bank_name' => $request->bank_name,
                    'branch_code' => $request->branch_code,
                    'bank_branch' => $request->bank_branch,
                    'account_name' => ucfirst($request->account_name),
                    'account_number' => $request->account_number,

                    'blood_group_id' => $request->blood_group,

                    'disability' => $request->disability,
                    'disability_details' => $request->disability_details,

                    'health' => $request->medical_condition,
                    'health_details' => $request->medical_condition_description
                ]);
                if ($employee) {
                    //create user
                    $user = new User([
                        'employee_id'=>$employee->id,
                        'name'=>$request->f_name,
                        'email'=>$request->work_email,
                    ]);
                    $user->password = Hash::make('TBL@2022');
                    $user->save();

                    Mail::to($request->work_email)->send(new UserCreated($user));

                    if ($user) {
                        $designation = Designation::where('id', $request->designation_id)->get()->first();
                        $role = Role::where('name', $designation->name)->get()->first();
                        $role->givePermissionTo(Permission::all());
                        $user->assignRole($role);
                    }

                    NextOfKin::recordNextOfKin($request->input('nextOfKin'), $employee->id);

                    EmployeeEducation::recordEducation($request->input('educationDetails'), $employee->id);

                    return  response()->json([
                        'status' => true,
                        'message' => 'Employee created successfully'
                    ]);
                }
    }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        if (Auth::user()->hasAnyRole('Human Resource Manager|Admin|BPO Director|Head of Operations|Operations Manager|Human Resouce Manager|Human Resouce Executive')) {
            return view('hrm.employees.show', ['employee' => $employee]);
        }
        //show
        // dd($employee);
        return abort(403, 'Unauthorized');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employee::all();
        $genders = Gender::all();
        $countries = Country::all();
        $statuses = EmployeeStatus::all();
        $contract_types = Contract::all();
        $departments = Department::all();
        $currencies = Currency::all();
        $designation = Designation::all();
        $teams = Team::all();
        $projects = Project::where('status', 1)->get();
        $blood_groups = BloodGroup::all();
        $disabilityStatus = DisabilityStatus::all();
        $healthStatus = HealthStatus::all();
        $languages = Language::all();
        $educationLevels = EducationLevel::all();
        $employee = Employee::where('id', $id)->with('educations')->with('nextOfKins')->first();
        if (Auth::user()->hasAnyRole('Human Resource Manager|Admin|BPO Director|Head of Operations|Operations Manager|Human Resouce Manager|Human Resouce Executive')) {
            return view('hrm.employees.edit')
                ->with('countries', $countries)
                ->with('currencies', $currencies)
                ->with('employees', $employees)
                ->with('statuses', $statuses)
                ->with('education_levels', $educationLevels)
                ->with('departments', $departments)
                ->with('blood_groups', $blood_groups)
                ->with('disability', $disabilityStatus)
                ->with('health', $healthStatus)
                ->with('projects', $projects)
                ->with('teams', $teams)
                ->with('designations', $designation)
                ->with('languages', $languages)
                ->with('contract_types', $contract_types)
                ->with('currentEmployee', $employee)
                ->with('genders', $genders);
        }

        return abort(403, 'Unauthorized');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(Employee $employee, Request $request)
    {
        $this->check_permission('Manage Employees');

        $this->validate($request, ['section' => 'string|required|max:50']);

        if ($request->section == "personal_info") {
            $employee->update([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'work_email' => $request->work_email,
                'personal_email' => $request->personal_email,
                'marital_status_id' => $request->marital_status_id,
                'gender_id' => $request->gender_id,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'residence' => $request->residence,
                'permanent_address' => $request->permanent_address,
            ]);
        //     if($request->has('language')){
        //         // dd('lang');
        //     EmployeeLanguage::where('employee_id', $employee->id)->update([
        //         'language_id'=>$employee->languages()->pluck('language_id')->first(),
        //     ]);
        // }
        } elseif ($request->section == "employment_info") {
            $employee->update([
                'contract_id' => $request->contract_id,
                'contract_start' => $request->contract_start,
                'contract_expiry' => $request->contract_expiry,
                'currency_id' => $request->currency_id,
                'basic_salary' => $request->basic_salary,
                'team_id'=>$request->team_id,
                'department_id'=>$request->department_id,
                'designation_id'=>$request->designation_id,
                'project_id'=>$request->project_id,
                'team_id'=>$request->team_id,
            ]);
        } elseif ($request->section == "statutory_info") {
            $employee->update([
                'country_id' => $request->country_id,
                'national_id' => $request->national_id,
                'huduma_number' => $request->huduma_number,
                'passport_number' => $request->passport_number,
                'kra_pin' => $request->kra_pin,
                'nhif' => $request->nhif,
                'nssf' => $request->nssf,
            ]);
        } elseif ($request->section == "bank_info") {
            $employee->update([
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'branch_code' => $request->branch_code,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
            ]);
        } elseif ($request->section == "next_of_kin") {
            // dd($request->all());
            NextOfKin::updateOrCreate(
                [
                'id'=>$request->kin_id,
                ],
                [
                'full_name'=>$request->full_name,
                'relationship'=>$request->relationship,
                'phone1'=>$request->phone1
            ]);
        } elseif ($request->section == "education") {
            EmployeeEducation::updateOrCreate(
                [
                'id'=>$request->edu_id,
                ],
                [
                'institution'=>$request->institution,
                'education_level_id'=>$request->education_level_id,
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date,
                'field_of_study'=>$request->field_of_study,
            ]);
        } elseif ($request->section == "languages") {
            EmployeeLanguage::updateOrCreate(
                [
                'id'=>$request->lang_id,
                ],
                [
                // 'language_id'=>$request->language_id,
            ]);
        }
        Session::flash('success', "Employee details have been updated successfully");
        return Redirect::back();
        }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee, Request $request)
    {
        $employee = Employee::findOrFail($request->employee_id);
        // dd($employee);
        $employee->attri_type = $request->attri_type;
        $employee->attri_reason = $request->attri_reason;
        $employee->save();
        // return back()->with('warning', 'Delete disabled!');
        if ($employee->delete()){

            $ts = Carbon::now()->toDateTimeString();
            $data = array('deleted_at' => $ts);
            DB::table('users')->where('id', $employee->user->id)->update($data);
            // return  redirect()->route('employees.index')->with('success','Employee deleted successfully');
            Session::flash('success', "Employee details have been deleted successfully");
            return Redirect::back();

        }
        return  redirect()->route('employees.index')->with('error','Employee not deleted');
    }
    public function import(Request $request)
    {
        // try {
        //     $request->validate([
        //         'file_to_import'=>'required'
        //     ]);
        // } catch (\Throwable $th) {
        //     throw( $th);
        // }
        $temp_path = $request->file('file_to_import')->store('temp');
        $path = storage_path('app') . '/' . $temp_path;
        $data = Excel::import(new EmployeesImport, $path);
        return redirect::back()->with('success', 'All records have been uploaded. All good!');
    }
    public function download_emp_upload_template()
    {
        return response()->download(storage_path('app/public/templates/opscore_employees_upload_template.xlsx'));
    }

    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }
    public function search_by_sap(Request $request, Employee $employee)
    {
        /* $employee=Employee::where('sap','LIKE','%'.$request->sap.'%')->first();

        if($employee){
            return view('hrm.employees.show',['employee'=>$employee]);
        }
        else{
            if($request->sap)
            return redirect()->back()->with('error','Sap Not found, Kindly re-enter carefully');
        }
        */
    }

    //searches for employee using  employee_name, sap
    public function search_employee(Request $request, Employee $employee)
    {
        /* $employee=Employee::where('first_name','LIKE','%'.$request->employee_name.'%')->first();
        if($employee){
            return view('hrm.employees.show', ['employee'=>$employee]);
        }
        else{
            if($request->employee_name){
                return redirect()->back()->with('error', 'Name not found, please enter first name alone');
            }
        }
        */

        $employee = Employee::when($request->employee_name, function ($query) use ($request) {
                $query->where('first_name', 'LIKE', '%' . $request->employee_name . '%');
            })
            ->when($request->sap, function ($query) use ($request) {
                $query->where('sap', 'LIKE', '%' . $request->sap . '%');
            })
            ->first();

        if ($employee) {

            return view('hrm.employees.show', ['employee' => $employee]);
        } else {
            return redirect()->back()->with('error', 'Please re-enter your details well');
        }
    }

	public function restore($id)
	{
		Employee::withTrashed()->find($id)->restore();
		return redirect()->route('employees.index');
	}
	public function restoreAll()
	{
		Employee::onlyTrashed()->restore();
		return redirect()->route('employees.index');
	}
    public function forcedelete()
	{
		Employee::onlyTrashed()->forceDelete();
		return redirect()->route('employees.index');
	}

}
