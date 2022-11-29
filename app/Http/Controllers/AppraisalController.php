<?php

namespace App\Http\Controllers;

use App\Models\Appraisal;
use App\Models\AppraisalSectionA;
use App\Models\AppraisalSectionB;
use App\Models\AppraisalSectionC;
use App\Models\AppraisalSectionD;
use App\Models\AppraisalSectionResult;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AppraisalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $user=auth()->user();

        if ($user->hasRole('Admin|Super Admin')) {


            $appraisals=Appraisal::with('employee.department')
                ->with('employee.designation')
                ->where('status','submitted')
                ->get();


            return view('appraisals.super_admin.index')->with('appraisals',$appraisals);
        }
        else{


            $need_appraisals=Appraisal::with('employee.department')
                ->with('employee.designation')
                -> where('appraiser_id',$user->employee->id)
                ->where('status','submitted')
                ->get();

            $sectionA=AppraisalSectionA::all();
            $sectionB=AppraisalSectionB::all();
            $sectionC=AppraisalSectionC::all();

            return view('appraisals.index')->with('a_appraisals',$sectionA)
                ->with('need_approvals',$need_appraisals)
                ->with('b_appraisals',$sectionB)->with('c_appraisals',$sectionC);
        }

    }

    public  function  review($employeeId,$appraisalId){


        $employee=Employee::find($employeeId);
        $isManager=false;
        $checkStatus=Employee::where('report_to',$employee->id)->first();

        if ($employee->designation_id==3 || $employee->designation_id==4) {
            $sectionA=AppraisalSectionA::where('designation_id',3)->orWhere('designation_id',4)->get();
            $sectionB=AppraisalSectionB::where('designation_id',3)->orWhere('designation_id',4)->get();
            $sectionC=AppraisalSectionC::where('id','<=',4)->get();
            $sectionD=AppraisalSectionD::all();
            $designation=$employee->designation_id;

            if ($checkStatus){

                $isManager=true;
                return view('appraisals.review')->with('a_appraisals',$sectionA)
                    ->with('employee_id',$employeeId)->with('employee',$employee)
                    ->with('appraisal_id',$appraisalId)
                    ->with('isManager',$isManager)
                    ->with('d_appraisals',$sectionD)
                    ->with('designation',$designation)
                    ->with('b_appraisals',$sectionB)->with('c_appraisals',$sectionC);
            }

            return view('appraisals.review')->with('a_appraisals',$sectionA)
                ->with('employee_id',$employeeId)->with('employee',$employee)
                ->with('appraisal_id',$appraisalId)
                ->with('isManager',$isManager)
                ->with('d_appraisals',$sectionD)
                ->with('designation',$designation)
                ->with('b_appraisals',$sectionB)->with('c_appraisals',$sectionC);

        }
        else if ($employee->designation_id==24) {
            $sectionA=AppraisalSectionA::where('designation_id',24)->get();
            $sectionB=AppraisalSectionB::where('designation_id',24)->get();
            $sectionC=AppraisalSectionC::where('id','<=',4)->get();
            $sectionD=AppraisalSectionD::all();
            $designation=$employee->designation_id;

            if ($checkStatus){

                $isManager=true;
                return view('appraisals.review')->with('a_appraisals',$sectionA)
                    ->with('employee_id',$employeeId)->with('employee',$employee)
                    ->with('appraisal_id',$appraisalId)
                    ->with('isManager',$isManager)
                    ->with('d_appraisals',$sectionD)
                    ->with('designation',$designation)
                    ->with('b_appraisals',$sectionB)->with('c_appraisals',$sectionC);
            }

            return view('appraisals.review')->with('a_appraisals',$sectionA)
                ->with('employee_id',$employeeId)->with('employee',$employee)
                ->with('appraisal_id',$appraisalId)
                ->with('isManager',$isManager)
                ->with('d_appraisals',$sectionD)
                ->with('designation',$designation)
                ->with('b_appraisals',$sectionB)->with('c_appraisals',$sectionC);

        }
        else if ($employee->designation_id==11) {
            $sectionA=AppraisalSectionA::where('designation_id',11)->get();
            $sectionB=AppraisalSectionB::where('designation_id',11)->get();
            $sectionC=AppraisalSectionC::where('id','<=',4)->get();
            $sectionD=AppraisalSectionD::all();
            $designation=$employee->designation_id;

            if ($checkStatus){

                $isManager=true;
                return view('appraisals.review')->with('a_appraisals',$sectionA)
                    ->with('employee_id',$employeeId)->with('employee',$employee)
                    ->with('appraisal_id',$appraisalId)
                    ->with('isManager',$isManager)
                    ->with('d_appraisals',$sectionD)
                    ->with('designation',$designation)
                    ->with('b_appraisals',$sectionB)->with('c_appraisals',$sectionC);
            }

            return view('appraisals.review')->with('a_appraisals',$sectionA)
                ->with('employee_id',$employeeId)->with('employee',$employee)
                ->with('appraisal_id',$appraisalId)
                ->with('isManager',$isManager)
                ->with('d_appraisals',$sectionD)
                ->with('designation',$designation)
                ->with('b_appraisals',$sectionB)->with('c_appraisals',$sectionC);

        }
        else if ($employee->designation_id==10) {
            $sectionA=AppraisalSectionA::where('designation_id',10)->get();
            $sectionB=AppraisalSectionB::where('id','<=',4)->get();
            $sectionC=AppraisalSectionC::where('id','<=',4)->get();
            $sectionD=AppraisalSectionD::all();
            $designation=$employee->designation_id;

            if ($checkStatus){

                $isManager=true;
                return view('appraisals.review')->with('a_appraisals',$sectionA)
                    ->with('employee_id',$employeeId)->with('employee',$employee)
                    ->with('appraisal_id',$appraisalId)
                    ->with('isManager',$isManager)
                    ->with('d_appraisals',$sectionD)
                    ->with('designation',$designation)
                    ->with('b_appraisals',$sectionB)->with('c_appraisals',$sectionC);
            }

            return view('appraisals.review')->with('a_appraisals',$sectionA)
                ->with('employee_id',$employeeId)->with('employee',$employee)
                ->with('appraisal_id',$appraisalId)
                ->with('isManager',$isManager)
                ->with('d_appraisals',$sectionD)
                ->with('designation',$designation)
                ->with('b_appraisals',$sectionB)->with('c_appraisals',$sectionC);

        }
        else if ($employee->designation_id==23) {
            $sectionA=AppraisalSectionA::where('designation_id',23)->get();
            $sectionB=AppraisalSectionB::where('id','<=',4)->get();
            $sectionC=AppraisalSectionC::where('id','<=',4)->get();
            $sectionD=AppraisalSectionD::all();
            $designation=$employee->designation_id;

            if ($checkStatus){

                $isManager=true;
                return view('appraisals.review')->with('a_appraisals',$sectionA)
                    ->with('employee_id',$employeeId)->with('employee',$employee)
                    ->with('appraisal_id',$appraisalId)
                    ->with('isManager',$isManager)
                    ->with('d_appraisals',$sectionD)
                    ->with('designation',$designation)
                    ->with('b_appraisals',$sectionB)->with('c_appraisals',$sectionC);
            }

            return view('appraisals.review')->with('a_appraisals',$sectionA)
                ->with('employee_id',$employeeId)->with('employee',$employee)
                ->with('appraisal_id',$appraisalId)
                ->with('isManager',$isManager)
                ->with('d_appraisals',$sectionD)
                ->with('designation',$designation)
                ->with('b_appraisals',$sectionB)->with('c_appraisals',$sectionC);

        }
        else if ($employee->designation_id==5 || $employee->designation_id==6 ||
            $employee->designation_id==7 || $employee->designation_id==8) {
            $sectionA=AppraisalSectionA::where('designation_id',5)->get();
            $sectionB=AppraisalSectionB::where('id','<=',4)->get();
            $sectionC=AppraisalSectionC::where('id','<=',4)->get();
            $sectionD=AppraisalSectionD::all();
            $designation=$employee->designation_id;

            if ($checkStatus){

                $isManager=true;
                return view('appraisals.review')->with('a_appraisals',$sectionA)
                    ->with('employee_id',$employeeId)->with('employee',$employee)
                    ->with('appraisal_id',$appraisalId)
                    ->with('isManager',$isManager)
                    ->with('d_appraisals',$sectionD)
                    ->with('designation',$designation)
                    ->with('b_appraisals',$sectionB)->with('c_appraisals',$sectionC);
            }

            return view('appraisals.review')->with('a_appraisals',$sectionA)
                ->with('employee_id',$employeeId)->with('employee',$employee)
                ->with('appraisal_id',$appraisalId)
                ->with('isManager',$isManager)
                ->with('d_appraisals',$sectionD)
                ->with('designation',$designation)
                ->with('b_appraisals',$sectionB)->with('c_appraisals',$sectionC);

        }
        else if ($employee->designation_id==1) {
            $sectionA=AppraisalSectionA::where('designation_id',1)->get();
            $sectionB=AppraisalSectionB::where('designation_id',1)->get();
            $sectionC=AppraisalSectionC::where('id','<=',4)->get();
            $sectionD=AppraisalSectionD::all();
            $designation=$employee->designation_id;

            if ($checkStatus){

                $isManager=true;
                return view('appraisals.review')->with('a_appraisals',$sectionA)
                    ->with('employee_id',$employeeId)->with('employee',$employee)
                    ->with('appraisal_id',$appraisalId)
                    ->with('isManager',$isManager)
                    ->with('d_appraisals',$sectionD)
                    ->with('designation',$designation)
                    ->with('b_appraisals',$sectionB)->with('c_appraisals',$sectionC);
            }

            return view('appraisals.review')->with('a_appraisals',$sectionA)
                ->with('employee_id',$employeeId)->with('employee',$employee)
                ->with('appraisal_id',$appraisalId)
                ->with('isManager',$isManager)
                ->with('d_appraisals',$sectionD)
                ->with('designation',$designation)
                ->with('b_appraisals',$sectionB)->with('c_appraisals',$sectionC);

        }



    }

    public  function  mine(){
        $user=User::find(auth()->user()->id);

        $appraisals=Appraisal::with('employee.department')
            ->with('employee.designation')
            ->with('appraiser.department')
            ->with('appraiser.designation')
            ->where('employee_id',$user->employee->id)
            ->get();

        return view('appraisals.mine')->with('appraisals',$appraisals);
    }

    public  function  myResult($appraisalId){

        $results=AppraisalSectionResult::with('resultable')
         ->where('appraisal_id',$appraisalId)->get();


        return view('appraisals.result')->with('results',$results);

    }

    public  function acknowledge($appraisalId){
        $appraisal=Appraisal::find($appraisalId);
        $appraisal->status='acknowledged';
        if ($appraisal->save()){
            return redirect()->route('my_appraisals');
        }
    }
    public  function reject($appraisalId){
        $appraisal=Appraisal::find($appraisalId);
        $appraisal->status='submitted';
        if ($appraisal->save()){
            return redirect()->route('my_appraisals');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {

        $user=auth()->user();
        $checkStatus=Employee::where('report_to',$user->employee->id)->first();

        if ($user->employee->designation_id==3 || $user->employee->designation_id==4){


            $sectionA=AppraisalSectionA::where('designation_id',3)->orWhere('designation_id',4)->get();
            $sectionB=AppraisalSectionB::where('designation_id',3)->orWhere('designation_id',4)->get();
            $sectionC=AppraisalSectionC::where('id','<=',4)->get();
            $sectionD=AppraisalSectionD::all();
            $designation=$user->employee->designation_id;

            if ($checkStatus){
                $isManager=true;
                return view('appraisals.create')
                    ->with('a_appraisals',$sectionA)
                    ->with('isManager',$isManager)
                    ->with('b_appraisals',$sectionB)
                    ->with('d_appraisals',$sectionD)
                    ->with('designation',$designation)
                    ->with('c_appraisals',$sectionC);
            }
            $isManager=false;

            return view('appraisals.create')->with('a_appraisals',$sectionA)
                ->with('designation',$designation)
                ->with('isManager',$isManager)->with('b_appraisals',$sectionB)
                ->with('c_appraisals',$sectionC)->with('d_appraisals',$sectionD);
        }
        if ($user->employee->designation_id==5 ||
            $user->employee->designation_id==6 ||
            $user->employee->designation_id==7 ||
            $user->employee->designation_id==8){



            $sectionA=AppraisalSectionA::where('designation_id',5)->get();
            $sectionB=AppraisalSectionB::where('id','<=',4)->get();
            $sectionC=AppraisalSectionC::where('id','<=',4)->get();
            $sectionD=AppraisalSectionD::all();
            $designation=$user->employee->designation_id;

            if ($checkStatus){
                $isManager=true;
                return view('appraisals.create')
                    ->with('a_appraisals',$sectionA)
                    ->with('isManager',$isManager)
                    ->with('b_appraisals',$sectionB)
                    ->with('d_appraisals',$sectionD)
                    ->with('designation',$designation)
                    ->with('c_appraisals',$sectionC);
            }
            $isManager=false;

            return view('appraisals.create')->with('a_appraisals',$sectionA)
                ->with('designation',$designation)
                ->with('isManager',$isManager)->with('b_appraisals',$sectionB)
                ->with('c_appraisals',$sectionC)->with('d_appraisals',$sectionD);
        }

        else if ($user->employee->designation_id==24){
            $sectionA=AppraisalSectionA::where('designation_id',24)->get();
            $sectionB=AppraisalSectionB::where('designation_id',24)->get();
            $sectionC=AppraisalSectionC::where('id','<=',4)->get();
            $sectionD=AppraisalSectionD::all();
            $designation=$user->employee->designation_id;

            if ($checkStatus){
                $isManager=true;
                return view('appraisals.create')
                    ->with('a_appraisals',$sectionA)
                    ->with('isManager',$isManager)
                    ->with('b_appraisals',$sectionB)
                    ->with('d_appraisals',$sectionD)
                    ->with('designation',$designation)
                    ->with('c_appraisals',$sectionC);
            }
            $isManager=false;

            return view('appraisals.create')->with('a_appraisals',$sectionA)
                ->with('designation',$designation)
                ->with('isManager',$isManager)->with('b_appraisals',$sectionB)
                ->with('c_appraisals',$sectionC)->with('d_appraisals',$sectionD);
        }
        else if ($user->employee->designation_id==1){
            $sectionA=AppraisalSectionA::where('designation_id',1)->get();
            $sectionB=AppraisalSectionB::where('designation_id',1)->get();
            $sectionC=AppraisalSectionC::where('id','<=',4)->get();
            $sectionD=AppraisalSectionD::all();
            $designation=$user->employee->designation_id;

            if ($checkStatus){
                $isManager=true;
                return view('appraisals.create')
                    ->with('a_appraisals',$sectionA)
                    ->with('isManager',$isManager)
                    ->with('b_appraisals',$sectionB)
                    ->with('d_appraisals',$sectionD)
                    ->with('designation',$designation)
                    ->with('c_appraisals',$sectionC);
            }
            $isManager=false;

            return view('appraisals.create')->with('a_appraisals',$sectionA)
                ->with('designation',$designation)
                ->with('isManager',$isManager)->with('b_appraisals',$sectionB)
                ->with('c_appraisals',$sectionC)->with('d_appraisals',$sectionD);
        }
        else if ($user->employee->designation_id==11 || $user->employee->designation_id==13){


            $sectionA=AppraisalSectionA::where('designation_id',11)->get();
            $sectionB=AppraisalSectionB::where('designation_id',11)->get();
            $sectionC=AppraisalSectionC::where('id','<=',4)->get();
            $sectionD=AppraisalSectionD::all();
            $designation=$user->employee->designation_id;


            if ($checkStatus){
                $isManager=true;
                return view('appraisals.create')
                    ->with('a_appraisals',$sectionA)
                    ->with('isManager',$isManager)
                    ->with('b_appraisals',$sectionB)
                    ->with('d_appraisals',$sectionD)
                    ->with('designation',$designation)
                    ->with('c_appraisals',$sectionC);
            }
            $isManager=false;

            return view('appraisals.create')->with('a_appraisals',$sectionA)
                ->with('designation',$designation)
                ->with('isManager',$isManager)->with('b_appraisals',$sectionB)
                ->with('c_appraisals',$sectionC)->with('d_appraisals',$sectionD);
        }
        else if ($user->employee->designation_id==10){

            $sectionA=AppraisalSectionA::where('designation_id',10)->get();
            $sectionB=AppraisalSectionB::where('id','<=',4)->get();
            $sectionC=AppraisalSectionC::where('id','<=',4)->get();
            $sectionD=AppraisalSectionD::all();
            $designation=$user->employee->designation_id;

            if ($checkStatus){
                $isManager=true;
                return view('appraisals.create')
                    ->with('a_appraisals',$sectionA)
                    ->with('isManager',$isManager)
                    ->with('b_appraisals',$sectionB)
                    ->with('d_appraisals',$sectionD)
                    ->with('designation',$designation)
                    ->with('c_appraisals',$sectionC);
            }
            $isManager=false;

            return view('appraisals.create')->with('a_appraisals',$sectionA)
                ->with('designation',$designation)
                ->with('isManager',$isManager)->with('b_appraisals',$sectionB)
                ->with('c_appraisals',$sectionC)->with('d_appraisals',$sectionD);
        }
        else if ($user->employee->designation_id==17){


            $sectionA=AppraisalSectionA::where('designation_id',17)->get();
            $sectionB=AppraisalSectionB::where('designation_id',17)->get();
            $sectionC=AppraisalSectionC::where('id','<=',4)->get();
            $sectionD=AppraisalSectionD::all();
            $designation=$user->employee->designation_id;

            if ($checkStatus){
                $isManager=true;
                return view('appraisals.create')
                    ->with('a_appraisals',$sectionA)
                    ->with('isManager',$isManager)
                    ->with('b_appraisals',$sectionB)
                    ->with('d_appraisals',$sectionD)
                    ->with('designation',$designation)
                    ->with('c_appraisals',$sectionC);
            }
            $isManager=false;

            return view('appraisals.create')->with('a_appraisals',$sectionA)
                ->with('designation',$designation)
                ->with('isManager',$isManager)->with('b_appraisals',$sectionB)
                ->with('c_appraisals',$sectionC)->with('d_appraisals',$sectionD);
        }
        else if ($user->employee->designation_id==23){


            $sectionA=AppraisalSectionA::where('designation_id',23)->get();
            $sectionB=AppraisalSectionB::where('id','<=',4)->get();
            $sectionC=AppraisalSectionC::where('id','<=',4)->get();
            $sectionD=AppraisalSectionD::all();
            $designation=$user->employee->designation_id;

            if ($checkStatus){
                $isManager=true;
                return view('appraisals.create')
                    ->with('a_appraisals',$sectionA)
                    ->with('isManager',$isManager)
                    ->with('b_appraisals',$sectionB)
                    ->with('d_appraisals',$sectionD)
                    ->with('designation',$designation)
                    ->with('c_appraisals',$sectionC);
            }
            $isManager=false;


            return view('appraisals.create')->with('a_appraisals',$sectionA)
                ->with('designation',$designation)
                ->with('isManager',$isManager)->with('b_appraisals',$sectionB)
                ->with('c_appraisals',$sectionC)->with('d_appraisals',$sectionD);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[

            'sectionB1Rating'=>'required',
            'sectionB2Rating'=>'required',
            'sectionB3Rating'=>'required',
            'sectionB4Rating'=>'required',

            'keyDevelopmentAreasComment'=>'required',
            'keyStrengthComment'=>'required'
        ]);

        $user=User::find(auth()->user()->id);

        $exist=Appraisal::where('employee_id',$user->employee->id)->where('record_year',now()->year)->get();

        if ($exist->count() > 0){

            return  response()->json([
                'status'=>false,
                'message'=>'Your Appraisal for this already captured'
            ]);
        }
        $user=User::find(auth()->user()->id);



        $appraisal=Appraisal::create([
            'appraiser_id'=>$user->employee->appraiser->id,
            'employee_id'=>$user->employee->id,
            'status'=>'submitted',
            'record_year'=>now()->year
        ]);


        if ($appraisal){

            if ($user->employee->designation_id==1) {


                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA1,
                    'employee_remarks'=>$request->sectionAKRA1Remarks,
                    'actual_performance'=>0.3 * $request->sectionAKRA1,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA2,
                    'employee_remarks'=>$request->sectionAKRA2Remarks,
                    'actual_performance'=>0.15 * $request->sectionAKRA2,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>3,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA3,
                    'employee_remarks'=>$request->sectionAKRA3Remarks,
                    'actual_performance'=>0.2 * $request->sectionAKRA3,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>4,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA4,
                    'employee_remarks'=>$request->sectionAKRA4Remarks,
                    'actual_performance'=>0.15 * $request->sectionAKRA4,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>5,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA5,
                    'employee_remarks'=>$request->sectionAKRA5Remarks,
                    'actual_performance'=>0.10 * $request->sectionAKRA5,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>6,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA6,
                    'employee_remarks'=>$request->sectionAKRA6Remarks,
                    'actual_performance'=>0.05 * $request->sectionAKRA6,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>7,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA7,
                    'employee_remarks'=>$request->sectionAKRA7Remarks,
                    'actual_performance'=>0.05 * $request->sectionAKRA17,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB1Rating,
                    'employee_remarks'=>$request->sectionB1Remarks,
                    'actual_performance'=>0.25 * $request->sectionB1Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB2Rating,
                    'employee_remarks'=>$request->sectionB2Remarks,
                    'actual_performance'=>0.25 * $request->sectionB2Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>3,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB3Rating,
                    'employee_remarks'=>$request->sectionB3Remarks,
                    'actual_performance'=>0.25 * $request->sectionB3Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>4,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB4Rating,
                    'employee_remarks'=>$request->sectionB4Remarks,
                    'actual_performance'=>0.25 * $request->sectionB4Rating,
                    'overall_rating'=>5
                ]);

                if ($request->has('sectionC1Rating')){
                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>1,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC1Rating,
                        'employee_remarks'=>$request->sectionC1Remarks,
                        'actual_performance'=>0.25 * $request->sectionC1Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>2,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC2Rating,
                        'employee_remarks'=>$request->sectionC2Remarks,
                        'actual_performance'=>0.25 * $request->sectionC2Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>3,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC3Rating,
                        'employee_remarks'=>$request->sectionC3Remarks,
                        'actual_performance'=>0.25 * $request->sectionC3Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>4,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC4Rating,
                        'employee_remarks'=>$request->sectionC4Remarks,
                        'actual_performance'=>0.25 * $request->sectionC4Rating,
                        'overall_rating'=>5
                    ]);
                }

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionD',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_remarks'=>$request->keyStrengthComment,
                    'overall_rating'=>0
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionD',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_remarks'=>$request->keyDevelopmentAreasComment,
                    'overall_rating'=>0
                ]);

                return  response()->json([
                    'status'=>true,
                    'message'=>'Appraisal submitted to your supervisor'
                ]);

            }
            else if ($user->employee->designation_id==5 || $user->employee->designation_id==6 ||
                $user->employee->designation_id==7 || $user->employee->designation_id==8) {


                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>33,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA1,
                    'employee_remarks'=>$request->sectionAKRA1Remarks,
                    'actual_performance'=>0.3 * $request->sectionAKRA1,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>34,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA2,
                    'employee_remarks'=>$request->sectionAKRA2Remarks,
                    'actual_performance'=>0.15 * $request->sectionAKRA2,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>35,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA3,
                    'employee_remarks'=>$request->sectionAKRA3Remarks,
                    'actual_performance'=>0.2 * $request->sectionAKRA3,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>36,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA4,
                    'employee_remarks'=>$request->sectionAKRA4Remarks,
                    'actual_performance'=>0.15 * $request->sectionAKRA4,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>37,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA5,
                    'employee_remarks'=>$request->sectionAKRA5Remarks,
                    'actual_performance'=>0.10 * $request->sectionAKRA5,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>38,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA6,
                    'employee_remarks'=>$request->sectionAKRA6Remarks,
                    'actual_performance'=>0.05 * $request->sectionAKRA6,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB1Rating,
                    'employee_remarks'=>$request->sectionB1Remarks,
                    'actual_performance'=>0.25 * $request->sectionB1Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB2Rating,
                    'employee_remarks'=>$request->sectionB2Remarks,
                    'actual_performance'=>0.25 * $request->sectionB2Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>3,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB3Rating,
                    'employee_remarks'=>$request->sectionB3Remarks,
                    'actual_performance'=>0.25 * $request->sectionB3Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>4,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB4Rating,
                    'employee_remarks'=>$request->sectionB4Remarks,
                    'actual_performance'=>0.25 * $request->sectionB4Rating,
                    'overall_rating'=>5
                ]);

                if ($request->has('sectionC1Rating')){
                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>1,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC1Rating,
                        'employee_remarks'=>$request->sectionC1Remarks,
                        'actual_performance'=>0.25 * $request->sectionC1Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>2,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC2Rating,
                        'employee_remarks'=>$request->sectionC2Remarks,
                        'actual_performance'=>0.25 * $request->sectionC2Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>3,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC3Rating,
                        'employee_remarks'=>$request->sectionC3Remarks,
                        'actual_performance'=>0.25 * $request->sectionC3Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>4,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC4Rating,
                        'employee_remarks'=>$request->sectionC4Remarks,
                        'actual_performance'=>0.25 * $request->sectionC4Rating,
                        'overall_rating'=>5
                    ]);
                }

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionD',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_remarks'=>$request->keyStrengthComment,
                    'overall_rating'=>0
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionD',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_remarks'=>$request->keyDevelopmentAreasComment,
                    'overall_rating'=>0
                ]);

                return  response()->json([
                    'status'=>true,
                    'message'=>'Appraisal submitted to your supervisor'
                ]);

            }
            else if ($user->employee->designation_id==17) {


                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>8,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA1,
                    'employee_remarks'=>$request->sectionAKRA1Remarks,
                    'actual_performance'=>0.3 * $request->sectionAKRA1,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>9,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA2,
                    'employee_remarks'=>$request->sectionAKRA2Remarks,
                    'actual_performance'=>0.15 * $request->sectionAKRA2,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>10,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA3,
                    'employee_remarks'=>$request->sectionAKRA3Remarks,
                    'actual_performance'=>0.2 * $request->sectionAKRA3,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>11,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA4,
                    'employee_remarks'=>$request->sectionAKRA4Remarks,
                    'actual_performance'=>0.15 * $request->sectionAKRA4,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>12,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA5,
                    'employee_remarks'=>$request->sectionAKRA5Remarks,
                    'actual_performance'=>0.10 * $request->sectionAKRA5,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>13,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA6,
                    'employee_remarks'=>$request->sectionAKRA6Remarks,
                    'actual_performance'=>0.05 * $request->sectionAKRA6,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB1Rating,
                    'employee_remarks'=>$request->sectionB1Remarks,
                    'actual_performance'=>0.25 * $request->sectionB1Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB2Rating,
                    'employee_remarks'=>$request->sectionB2Remarks,
                    'actual_performance'=>0.25 * $request->sectionB2Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>3,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB3Rating,
                    'employee_remarks'=>$request->sectionB3Remarks,
                    'actual_performance'=>0.25 * $request->sectionB3Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>4,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB4Rating,
                    'employee_remarks'=>$request->sectionB4Remarks,
                    'actual_performance'=>0.25 * $request->sectionB4Rating,
                    'overall_rating'=>5
                ]);

                if ($request->has('sectionC1Rating')){
                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>1,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC1Rating,
                        'employee_remarks'=>$request->sectionC1Remarks,
                        'actual_performance'=>0.25 * $request->sectionC1Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>2,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC2Rating,
                        'employee_remarks'=>$request->sectionC2Remarks,
                        'actual_performance'=>0.25 * $request->sectionC2Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>3,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC3Rating,
                        'employee_remarks'=>$request->sectionC3Remarks,
                        'actual_performance'=>0.25 * $request->sectionC3Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>4,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC4Rating,
                        'employee_remarks'=>$request->sectionC4Remarks,
                        'actual_performance'=>0.25 * $request->sectionC4Rating,
                        'overall_rating'=>5
                    ]);
                }

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionD',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_remarks'=>$request->keyStrengthComment,
                    'overall_rating'=>0
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionD',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_remarks'=>$request->keyDevelopmentAreasComment,
                    'overall_rating'=>0
                ]);

                return  response()->json([
                    'status'=>true,
                    'message'=>'Appraisal submitted to your supervisor'
                ]);

            }
            else if ($user->employee->designation_id==23) {


                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>59,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA1,
                    'employee_remarks'=>$request->sectionAKRA1Remarks,
                    'actual_performance'=>0.3 * $request->sectionAKRA1,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>60,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA2,
                    'employee_remarks'=>$request->sectionAKRA2Remarks,
                    'actual_performance'=>0.15 * $request->sectionAKRA2,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>61,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA3,
                    'employee_remarks'=>$request->sectionAKRA3Remarks,
                    'actual_performance'=>0.2 * $request->sectionAKRA3,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>62,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA4,
                    'employee_remarks'=>$request->sectionAKRA4Remarks,
                    'actual_performance'=>0.15 * $request->sectionAKRA4,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>63,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA5,
                    'employee_remarks'=>$request->sectionAKRA5Remarks,
                    'actual_performance'=>0.10 * $request->sectionAKRA5,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB1Rating,
                    'employee_remarks'=>$request->sectionB1Remarks,
                    'actual_performance'=>0.25 * $request->sectionB1Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB2Rating,
                    'employee_remarks'=>$request->sectionB2Remarks,
                    'actual_performance'=>0.25 * $request->sectionB2Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>3,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB3Rating,
                    'employee_remarks'=>$request->sectionB3Remarks,
                    'actual_performance'=>0.25 * $request->sectionB3Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>4,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB4Rating,
                    'employee_remarks'=>$request->sectionB4Remarks,
                    'actual_performance'=>0.25 * $request->sectionB4Rating,
                    'overall_rating'=>5
                ]);

                if ($request->has('sectionC1Rating')){
                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>1,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC1Rating,
                        'employee_remarks'=>$request->sectionC1Remarks,
                        'actual_performance'=>0.25 * $request->sectionC1Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>2,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC2Rating,
                        'employee_remarks'=>$request->sectionC2Remarks,
                        'actual_performance'=>0.25 * $request->sectionC2Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>3,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC3Rating,
                        'employee_remarks'=>$request->sectionC3Remarks,
                        'actual_performance'=>0.25 * $request->sectionC3Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>4,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC4Rating,
                        'employee_remarks'=>$request->sectionC4Remarks,
                        'actual_performance'=>0.25 * $request->sectionC4Rating,
                        'overall_rating'=>5
                    ]);
                }

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionD',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_remarks'=>$request->keyStrengthComment,
                    'overall_rating'=>0
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionD',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_remarks'=>$request->keyDevelopmentAreasComment,
                    'overall_rating'=>0
                ]);

                return  response()->json([
                    'status'=>true,
                    'message'=>'Appraisal submitted to your supervisor'
                ]);

            }
            else  if ($user->employee->designation_id==11) {


                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>50,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA1,
                    'employee_remarks'=>$request->sectionAKRA1Remarks,
                    'actual_performance'=>0.3 * $request->sectionAKRA1,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>51,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA2,
                    'employee_remarks'=>$request->sectionAKRA2Remarks,
                    'actual_performance'=>0.15 * $request->sectionAKRA2,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>52,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA3,
                    'employee_remarks'=>$request->sectionAKRA3Remarks,
                    'actual_performance'=>0.2 * $request->sectionAKRA3,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>53,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA4,
                    'employee_remarks'=>$request->sectionAKRA4Remarks,
                    'actual_performance'=>0.15 * $request->sectionAKRA4,
                    'overall_rating'=>5
                ]);


                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB1Rating,
                    'employee_remarks'=>$request->sectionB1Remarks,
                    'actual_performance'=>0.25 * $request->sectionB1Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB2Rating,
                    'employee_remarks'=>$request->sectionB2Remarks,
                    'actual_performance'=>0.25 * $request->sectionB2Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>3,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB3Rating,
                    'employee_remarks'=>$request->sectionB3Remarks,
                    'actual_performance'=>0.25 * $request->sectionB3Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>4,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB4Rating,
                    'employee_remarks'=>$request->sectionB4Remarks,
                    'actual_performance'=>0.25 * $request->sectionB4Rating,
                    'overall_rating'=>5
                ]);

                if ($request->has('sectionC1Rating')){
                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>1,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC1Rating,
                        'employee_remarks'=>$request->sectionC1Remarks,
                        'actual_performance'=>0.25 * $request->sectionC1Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>2,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC2Rating,
                        'employee_remarks'=>$request->sectionC2Remarks,
                        'actual_performance'=>0.25 * $request->sectionC2Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>3,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC3Rating,
                        'employee_remarks'=>$request->sectionC3Remarks,
                        'actual_performance'=>0.25 * $request->sectionC3Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>4,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC4Rating,
                        'employee_remarks'=>$request->sectionC4Remarks,
                        'actual_performance'=>0.25 * $request->sectionC4Rating,
                        'overall_rating'=>5
                    ]);
                }

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionD',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_remarks'=>$request->keyStrengthComment,
                    'overall_rating'=>0
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionD',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_remarks'=>$request->keyDevelopmentAreasComment,
                    'overall_rating'=>0
                ]);

                return  response()->json([
                    'status'=>true,
                    'message'=>'Appraisal submitted to your supervisor'
                ]);

            }
            else  if ($user->employee->designation_id==10) {

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>19,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA1,
                    'employee_remarks'=>$request->sectionAKRA1Remarks,
                    'actual_performance'=>0.3 * $request->sectionAKRA1,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>20,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA2,
                    'employee_remarks'=>$request->sectionAKRA2Remarks,
                    'actual_performance'=>0.15 * $request->sectionAKRA2,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>21,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA3,
                    'employee_remarks'=>$request->sectionAKRA3Remarks,
                    'actual_performance'=>0.2 * $request->sectionAKRA3,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>22,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA4,
                    'employee_remarks'=>$request->sectionAKRA4Remarks,
                    'actual_performance'=>0.15 * $request->sectionAKRA4,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB1Rating,
                    'employee_remarks'=>$request->sectionB1Remarks,
                    'actual_performance'=>0.25 * $request->sectionB1Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB2Rating,
                    'employee_remarks'=>$request->sectionB2Remarks,
                    'actual_performance'=>0.25 * $request->sectionB2Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>3,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB3Rating,
                    'employee_remarks'=>$request->sectionB3Remarks,
                    'actual_performance'=>0.25 * $request->sectionB3Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>4,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB4Rating,
                    'employee_remarks'=>$request->sectionB4Remarks,
                    'actual_performance'=>0.25 * $request->sectionB4Rating,
                    'overall_rating'=>5
                ]);

                if ($request->has('sectionC1Rating')){
                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>1,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC1Rating,
                        'employee_remarks'=>$request->sectionC1Remarks,
                        'actual_performance'=>0.25 * $request->sectionC1Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>2,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC2Rating,
                        'employee_remarks'=>$request->sectionC2Remarks,
                        'actual_performance'=>0.25 * $request->sectionC2Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>3,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC3Rating,
                        'employee_remarks'=>$request->sectionC3Remarks,
                        'actual_performance'=>0.25 * $request->sectionC3Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>4,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC4Rating,
                        'employee_remarks'=>$request->sectionC4Remarks,
                        'actual_performance'=>0.25 * $request->sectionC4Rating,
                        'overall_rating'=>5
                    ]);
                }

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionD',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_remarks'=>$request->keyStrengthComment,
                    'overall_rating'=>0
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionD',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_remarks'=>$request->keyDevelopmentAreasComment,
                    'overall_rating'=>0
                ]);

                return  response()->json([
                    'status'=>true,
                    'message'=>'Appraisal submitted to your supervisor'
                ]);

            }

        }



        return  response()->json([
            'status'=>false,
            'message'=>'Appraisal not submitted to your supervisor'
        ]);



    }
    public function operationManager(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'sectionAKRA1'=>'required',
            'sectionAKRA2'=>'required',
            'sectionAKRA3'=>'required',
            'sectionAKRA4'=>'required',
            'sectionAKRA5'=>'required',


            'sectionB1Rating'=>'required',
            'sectionB2Rating'=>'required',
            'sectionB3Rating'=>'required',
            'sectionB4Rating'=>'required',



            'keyDevelopmentAreasComment'=>'required',
            'keyStrengthComment'=>'required'
        ]);

        $user=User::find(auth()->user()->id);

        $exist=Appraisal::where('employee_id',$user->employee->id)->where('record_year',now()->year)->get();

        if ($exist->count() > 0){

            return  response()->json([
                'status'=>false,
                'message'=>'Your Appraisal for this already captured'
            ]);
        }
        $user=User::find(auth()->user()->id);



        $appraisal=Appraisal::create([
            'appraiser_id'=>$user->employee->appraiser->id,
            'employee_id'=>$user->employee->id,
            'status'=>'submitted',
            'record_year'=>now()->year
        ]);


        if ($appraisal){
            if ($user->employee->designation_id==3 || $user->employee->designation_id==4) {
                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>54,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA1,
                    'employee_remarks'=>$request->sectionAKRA1Remarks,
                    'actual_performance'=>0.3 * $request->sectionAKRA1,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>55,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA2,
                    'employee_remarks'=>$request->sectionAKRA2Remarks,
                    'actual_performance'=>0.15 * $request->sectionAKRA2,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>56,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA3,
                    'employee_remarks'=>$request->sectionAKRA3Remarks,
                    'actual_performance'=>0.2 * $request->sectionAKRA3,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>57,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA4,
                    'employee_remarks'=>$request->sectionAKRA4Remarks,
                    'actual_performance'=>0.15 * $request->sectionAKRA4,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>58,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA5,
                    'employee_remarks'=>$request->sectionAKRA5Remarks,
                    'actual_performance'=>0.10 * $request->sectionAKRA5,
                    'overall_rating'=>5
                ]);


                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB1Rating,
                    'employee_remarks'=>$request->sectionB1Remarks,
                    'actual_performance'=>0.25 * $request->sectionB1Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB2Rating,
                    'employee_remarks'=>$request->sectionB2Remarks,
                    'actual_performance'=>0.25 * $request->sectionB2Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>3,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB3Rating,
                    'employee_remarks'=>$request->sectionB3Remarks,
                    'actual_performance'=>0.25 * $request->sectionB3Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>4,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB4Rating,
                    'employee_remarks'=>$request->sectionB4Remarks,
                    'actual_performance'=>0.25 * $request->sectionB4Rating,
                    'overall_rating'=>5
                ]);

                if ($request->has('sectionC1Rating')){
                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>1,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC1Rating,
                        'employee_remarks'=>$request->sectionC1Remarks,
                        'actual_performance'=>0.25 * $request->sectionC1Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>2,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC2Rating,
                        'employee_remarks'=>$request->sectionC2Remarks,
                        'actual_performance'=>0.25 * $request->sectionC2Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>3,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC3Rating,
                        'employee_remarks'=>$request->sectionC3Remarks,
                        'actual_performance'=>0.25 * $request->sectionC3Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>4,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC4Rating,
                        'employee_remarks'=>$request->sectionC4Remarks,
                        'actual_performance'=>0.25 * $request->sectionC4Rating,
                        'overall_rating'=>5
                    ]);
                }

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionD',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_remarks'=>$request->keyStrengthComment,
                    'overall_rating'=>0
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionD',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_remarks'=>$request->keyDevelopmentAreasComment,
                    'overall_rating'=>0
                ]);
                return  response()->json([
                    'status'=>true,
                    'message'=>'Appraisal submitted to your supervisor'
                ]);
            }
            else if ($user->employee->designation_id==24){
                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>64,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA1,
                    'employee_remarks'=>$request->sectionAKRA1Remarks,
                    'actual_performance'=>0.3 * $request->sectionAKRA1,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>65,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA2,
                    'employee_remarks'=>$request->sectionAKRA2Remarks,
                    'actual_performance'=>0.15 * $request->sectionAKRA2,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>66,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA3,
                    'employee_remarks'=>$request->sectionAKRA3Remarks,
                    'actual_performance'=>0.2 * $request->sectionAKRA3,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>67,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA4,
                    'employee_remarks'=>$request->sectionAKRA4Remarks,
                    'actual_performance'=>0.15 * $request->sectionAKRA4,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>68,
                    'resultable_type'=>'App\Models\AppraisalSectionA',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionAKRA5,
                    'employee_remarks'=>$request->sectionAKRA5Remarks,
                    'actual_performance'=>0.10 * $request->sectionAKRA5,
                    'overall_rating'=>5
                ]);


                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB1Rating,
                    'employee_remarks'=>$request->sectionB1Remarks,
                    'actual_performance'=>0.25 * $request->sectionB1Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB2Rating,
                    'employee_remarks'=>$request->sectionB2Remarks,
                    'actual_performance'=>0.25 * $request->sectionB2Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>3,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB3Rating,
                    'employee_remarks'=>$request->sectionB3Remarks,
                    'actual_performance'=>0.25 * $request->sectionB3Rating,
                    'overall_rating'=>5
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>4,
                    'resultable_type'=>'App\Models\AppraisalSectionB',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_rating'=>$request->sectionB4Rating,
                    'employee_remarks'=>$request->sectionB4Remarks,
                    'actual_performance'=>0.25 * $request->sectionB4Rating,
                    'overall_rating'=>5
                ]);

                if ($request->has('sectionC1Rating')){
                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>1,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC1Rating,
                        'employee_remarks'=>$request->sectionC1Remarks,
                        'actual_performance'=>0.25 * $request->sectionC1Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>2,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC2Rating,
                        'employee_remarks'=>$request->sectionC2Remarks,
                        'actual_performance'=>0.25 * $request->sectionC2Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>3,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC3Rating,
                        'employee_remarks'=>$request->sectionC3Remarks,
                        'actual_performance'=>0.25 * $request->sectionC3Rating,
                        'overall_rating'=>5
                    ]);

                    AppraisalSectionResult::create([
                        'appraisal_id'=>$appraisal->id,
                        'resultable_id'=>4,
                        'resultable_type'=>'App\Models\AppraisalSectionC',
                        'employee_id'=>$user->employee->id,
                        'appraiser_id'=>$user->employee->appraiser->id,
                        'employee_rating'=>$request->sectionC4Rating,
                        'employee_remarks'=>$request->sectionC4Remarks,
                        'actual_performance'=>0.25 * $request->sectionC4Rating,
                        'overall_rating'=>5
                    ]);
                }

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>1,
                    'resultable_type'=>'App\Models\AppraisalSectionD',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_remarks'=>$request->keyStrengthComment,
                    'overall_rating'=>0
                ]);

                AppraisalSectionResult::create([
                    'appraisal_id'=>$appraisal->id,
                    'resultable_id'=>2,
                    'resultable_type'=>'App\Models\AppraisalSectionD',
                    'employee_id'=>$user->employee->id,
                    'appraiser_id'=>$user->employee->appraiser->id,
                    'employee_remarks'=>$request->keyDevelopmentAreasComment,
                    'overall_rating'=>0
                ]);

                return  response()->json([
                    'status'=>true,
                    'message'=>'Appraisal submitted to your supervisor'
                ]);
            }

        }



        return  response()->json([
            'status'=>false,
            'message'=>'Appraisal not submitted to your supervisor'
        ]);



    }


    public function operationManagerSupervisorReview(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'sectionAKRA1'=>'required',
            'sectionAKRA2'=>'required',
            'sectionAKRA3'=>'required',
            'sectionAKRA4'=>'required',
            'sectionAKRA5'=>'required',

            'sectionB1Rating'=>'required',
            'sectionB2Rating'=>'required',
            'sectionB3Rating'=>'required',
            'sectionB4Rating'=>'required',

            'employee_id'=>'required',
            'appraisal_id'=>'required',

            'keyDevelopmentAreasComment'=>'required',
            'keyStrengthComment'=>'required'
        ]);

        $user=User::find(auth()->user()->id);
        $employee=Employee::where('id',$request->employee_id)->first();


        if ($employee->designation_id==3 || $employee->designation_id==4) {

            $kra1=AppraisalSectionResult::where('resultable_id',54)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('employee_id',$request->employee_id)
                ->where('appraisal_id',$request->appraisal_id)
                ->first();
            $kra1->appraiser_rating=$request->sectionAKRA1;
            $kra1->appraiser_remarks=$request->sectionAKRA1Remarks;
            $kra1->save();

            $kra2=AppraisalSectionResult::where('resultable_id',55)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra2->appraiser_rating=$request->sectionAKRA2;
            $kra2->appraiser_remarks=$request->sectionAKRA2Remarks;
            $kra2->save();

            $kra3=AppraisalSectionResult::where('resultable_id',56)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra3->appraiser_rating=$request->sectionAKRA3;
            $kra3->appraiser_remarks=$request->sectionAKRA3Remarks;
            $kra3->save();

            $kra4=AppraisalSectionResult::where('resultable_id',57)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra4->appraiser_rating=$request->sectionAKRA4;
            $kra4->appraiser_remarks=$request->sectionAKRA4Remarks;
            $kra4->save();

            $kra5=AppraisalSectionResult::where('resultable_id',58)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra5->appraiser_rating=$request->sectionAKRA5;
            $kra5->appraiser_remarks=$request->sectionAKRA5Remarks;
            $kra5->save();



            $sb1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb1->appraiser_rating=$request->sectionB1Rating;
            $sb1->appraiser_remarks=$request->sectionB1Remarks;
            $sb1->save();

            $sb2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb2->appraiser_rating=$request->sectionB2Rating;
            $sb2->appraiser_remarks=$request->sectionB2Remarks;
            $sb2->save();

            $sb3=AppraisalSectionResult::where('resultable_id',3)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb3->appraiser_rating=$request->sectionB3Rating;
            $sb3->appraiser_remarks=$request->sectionB3Remarks;
            $sb3->save();

            $sb4=AppraisalSectionResult::where('resultable_id',4)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb4->appraiser_rating=$request->sectionB4Rating;
            $sb4->appraiser_remarks=$request->sectionB4Remarks;
            $sb4->save();

            if ($request->has('sectionC1Rating')){

                $sc1=AppraisalSectionResult::where('resultable_id',1)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc1->appraiser_rating=$request->sectionC1Rating;
                $sc1->appraiser_remarks=$request->sectionC1Remarks;
                $sc1->save();

                $sc2=AppraisalSectionResult::where('resultable_id',2)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc2->appraiser_rating=$request->sectionC2Rating;
                $sc2->appraiser_remarks=$request->sectionC2Remarks;
                $sc2->save();

                $sc3=AppraisalSectionResult::where('resultable_id',3)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc3->appraiser_rating=$request->sectionC3Rating;
                $sc3->appraiser_remarks=$request->sectionC3Remarks;
                $sc3->save();


                $sc4=AppraisalSectionResult::where('resultable_id',4)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc4->appraiser_rating=$request->sectionC4Rating;
                $sc4->appraiser_remarks=$request->sectionC4Remarks;
                $sc4->save();
            }


            $sd1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionD')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sd1->appraiser_remarks=$request->keyStrengthComment;
            $sd1->save();


            $sd2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionD')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sd2->appraiser_remarks=$request->keyStrengthComment;
            $sd2->save();




            $appraisal=Appraisal::find($request->appraisal_id);
            $appraisal->status='reviewed';
            if ( $appraisal->save()){

                return  response()->json([
                    'status'=>true,
                    'message'=>'Appraisal reviewed successfully'
                ]);

            }

            return  response()->json([
                'status'=>false,
                'message'=>'Appraisal not reviewed '
            ]);


        }
        else if ($employee->designation_id==24){
            $kra1=AppraisalSectionResult::where('resultable_id',64)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('employee_id',$request->employee_id)
                ->where('appraisal_id',$request->appraisal_id)
                ->first();
            $kra1->appraiser_rating=$request->sectionAKRA1;
            $kra1->appraiser_remarks=$request->sectionAKRA1Remarks;
            $kra1->save();

            $kra2=AppraisalSectionResult::where('resultable_id',65)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra2->appraiser_rating=$request->sectionAKRA2;
            $kra2->appraiser_remarks=$request->sectionAKRA2Remarks;
            $kra2->save();

            $kra3=AppraisalSectionResult::where('resultable_id',66)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra3->appraiser_rating=$request->sectionAKRA3;
            $kra3->appraiser_remarks=$request->sectionAKRA3Remarks;
            $kra3->save();

            $kra4=AppraisalSectionResult::where('resultable_id',67)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra4->appraiser_rating=$request->sectionAKRA4;
            $kra4->appraiser_remarks=$request->sectionAKRA4Remarks;
            $kra4->save();

            $kra5=AppraisalSectionResult::where('resultable_id',68)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra5->appraiser_rating=$request->sectionAKRA5;
            $kra5->appraiser_remarks=$request->sectionAKRA5Remarks;
            $kra5->save();



            $sb1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb1->appraiser_rating=$request->sectionB1Rating;
            $sb1->appraiser_remarks=$request->sectionB1Remarks;
            $sb1->save();

            $sb2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb2->appraiser_rating=$request->sectionB2Rating;
            $sb2->appraiser_remarks=$request->sectionB2Remarks;
            $sb2->save();

            $sb3=AppraisalSectionResult::where('resultable_id',3)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb3->appraiser_rating=$request->sectionB3Rating;
            $sb3->appraiser_remarks=$request->sectionB3Remarks;
            $sb3->save();

            $sb4=AppraisalSectionResult::where('resultable_id',4)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb4->appraiser_rating=$request->sectionB4Rating;
            $sb4->appraiser_remarks=$request->sectionB4Remarks;
            $sb4->save();

            if ($request->has('sectionC1Rating')){

                $sc1=AppraisalSectionResult::where('resultable_id',1)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc1->appraiser_rating=$request->sectionC1Rating;
                $sc1->appraiser_remarks=$request->sectionC1Remarks;
                $sc1->save();

                $sc2=AppraisalSectionResult::where('resultable_id',2)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc2->appraiser_rating=$request->sectionC2Rating;
                $sc2->appraiser_remarks=$request->sectionC2Remarks;
                $sc2->save();

                $sc3=AppraisalSectionResult::where('resultable_id',3)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc3->appraiser_rating=$request->sectionC3Rating;
                $sc3->appraiser_remarks=$request->sectionC3Remarks;
                $sc3->save();


                $sc4=AppraisalSectionResult::where('resultable_id',4)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc4->appraiser_rating=$request->sectionC4Rating;
                $sc4->appraiser_remarks=$request->sectionC4Remarks;
                $sc4->save();
            }


            $sd1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionD')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sd1->appraiser_remarks=$request->keyStrengthComment;
            $sd1->save();


            $sd2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionD')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sd2->appraiser_remarks=$request->keyStrengthComment;
            $sd2->save();




            $appraisal=Appraisal::find($request->appraisal_id);
            $appraisal->status='reviewed';
            if ( $appraisal->save()){

                return  response()->json([
                    'status'=>true,
                    'message'=>'Appraisal reviewed successfully'
                ]);

            }

            return  response()->json([
                'status'=>false,
                'message'=>'Appraisal not reviewed '
            ]);


        }


    }
    public function softwareDeveloperSupervisorReview(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'sectionB1Rating'=>'required',
            'sectionB2Rating'=>'required',
            'sectionB3Rating'=>'required',
            'sectionB4Rating'=>'required',

            'employee_id'=>'required',
            'appraisal_id'=>'required',

            'keyDevelopmentAreasComment'=>'required',
            'keyStrengthComment'=>'required'
        ]);

        $user=User::find(auth()->user()->id);
        $employee=Employee::where('id',$request->employee_id)->first();

        if ($employee->designation_id==1){


            $kra1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('employee_id',$request->employee_id)
                ->where('appraisal_id',$request->appraisal_id)
                ->first();
            $kra1->appraiser_rating=$request->sectionAKRA1;
            $kra1->appraiser_remarks=$request->sectionAKRA1Remarks;
            $kra1->save();

            $kra2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra2->appraiser_rating=$request->sectionAKRA2;
            $kra2->appraiser_remarks=$request->sectionAKRA2Remarks;
            $kra2->save();

            $kra3=AppraisalSectionResult::where('resultable_id',3)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra3->appraiser_rating=$request->sectionAKRA3;
            $kra3->appraiser_remarks=$request->sectionAKRA3Remarks;
            $kra3->save();

            $kra4=AppraisalSectionResult::where('resultable_id',4)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra4->appraiser_rating=$request->sectionAKRA4;
            $kra4->appraiser_remarks=$request->sectionAKRA4Remarks;
            $kra4->save();

            $kra5=AppraisalSectionResult::where('resultable_id',5)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra5->appraiser_rating=$request->sectionAKRA5;
            $kra5->appraiser_remarks=$request->sectionAKRA5Remarks;
            $kra5->save();

            $kra6=AppraisalSectionResult::where('resultable_id',6)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra6->appraiser_rating=$request->sectionAKRA6;
            $kra6->appraiser_remarks=$request->sectionAKRA6Remarks;
            $kra6->save();

            $kra7=AppraisalSectionResult::where('resultable_id',7)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra7->appraiser_rating=$request->sectionAKRA7;
            $kra7->appraiser_remarks=$request->sectionAKRA7Remarks;
            $kra7->save();



            $sb1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb1->appraiser_rating=$request->sectionB1Rating;
            $sb1->appraiser_remarks=$request->sectionB1Remarks;
            $sb1->save();

            $sb2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb2->appraiser_rating=$request->sectionB2Rating;
            $sb2->appraiser_remarks=$request->sectionB2Remarks;
            $sb2->save();

            $sb3=AppraisalSectionResult::where('resultable_id',3)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb3->appraiser_rating=$request->sectionB3Rating;
            $sb3->appraiser_remarks=$request->sectionB3Remarks;
            $sb3->save();

            $sb4=AppraisalSectionResult::where('resultable_id',4)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb4->appraiser_rating=$request->sectionB4Rating;
            $sb4->appraiser_remarks=$request->sectionB4Remarks;
            $sb4->save();

            if ($request->has('sectionC1Rating')){

                $sc1=AppraisalSectionResult::where('resultable_id',1)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc1->appraiser_rating=$request->sectionC1Rating;
                $sc1->appraiser_remarks=$request->sectionC1Remarks;
                $sc1->save();

                $sc2=AppraisalSectionResult::where('resultable_id',2)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc2->appraiser_rating=$request->sectionC2Rating;
                $sc2->appraiser_remarks=$request->sectionC2Remarks;
                $sc2->save();

                $sc3=AppraisalSectionResult::where('resultable_id',3)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc3->appraiser_rating=$request->sectionC3Rating;
                $sc3->appraiser_remarks=$request->sectionC3Remarks;
                $sc3->save();


                $sc4=AppraisalSectionResult::where('resultable_id',4)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc4->appraiser_rating=$request->sectionC4Rating;
                $sc4->appraiser_remarks=$request->sectionC4Remarks;
                $sc4->save();
            }


            $sd1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionD')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sd1->appraiser_remarks=$request->keyStrengthComment;
            $sd1->save();


            $sd2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionD')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sd2->appraiser_remarks=$request->keyStrengthComment;
            $sd2->save();




            $appraisal=Appraisal::find($request->appraisal_id);
            $appraisal->status='reviewed';

            if ( $appraisal->save()){

                return  response()->json([
                    'status'=>true,
                    'message'=>'Appraisal reviewed successfully'
                ]);

            }

            return  response()->json([
                'status'=>false,
                'message'=>'Appraisal not reviewed '
            ]);

        }
        else if ($employee->designation_id==5 || $employee->designation_id==6 ||
            $employee->designation_id==7 || $employee->designation_id==8){


            $kra1=AppraisalSectionResult::where('resultable_id',33)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('employee_id',$request->employee_id)
                ->where('appraisal_id',$request->appraisal_id)
                ->first();
            $kra1->appraiser_rating=$request->sectionAKRA1;
            $kra1->appraiser_remarks=$request->sectionAKRA1Remarks;
            $kra1->save();

            $kra2=AppraisalSectionResult::where('resultable_id',34)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra2->appraiser_rating=$request->sectionAKRA2;
            $kra2->appraiser_remarks=$request->sectionAKRA2Remarks;
            $kra2->save();

            $kra3=AppraisalSectionResult::where('resultable_id',35)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra3->appraiser_rating=$request->sectionAKRA3;
            $kra3->appraiser_remarks=$request->sectionAKRA3Remarks;
            $kra3->save();

            $kra4=AppraisalSectionResult::where('resultable_id',36)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra4->appraiser_rating=$request->sectionAKRA4;
            $kra4->appraiser_remarks=$request->sectionAKRA4Remarks;
            $kra4->save();

            $kra5=AppraisalSectionResult::where('resultable_id',37)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra5->appraiser_rating=$request->sectionAKRA5;
            $kra5->appraiser_remarks=$request->sectionAKRA5Remarks;
            $kra5->save();

            $kra6=AppraisalSectionResult::where('resultable_id',38)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra6->appraiser_rating=$request->sectionAKRA6;
            $kra6->appraiser_remarks=$request->sectionAKRA6Remarks;
            $kra6->save();


            $sb1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb1->appraiser_rating=$request->sectionB1Rating;
            $sb1->appraiser_remarks=$request->sectionB1Remarks;
            $sb1->save();

            $sb2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb2->appraiser_rating=$request->sectionB2Rating;
            $sb2->appraiser_remarks=$request->sectionB2Remarks;
            $sb2->save();

            $sb3=AppraisalSectionResult::where('resultable_id',3)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb3->appraiser_rating=$request->sectionB3Rating;
            $sb3->appraiser_remarks=$request->sectionB3Remarks;
            $sb3->save();

            $sb4=AppraisalSectionResult::where('resultable_id',4)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb4->appraiser_rating=$request->sectionB4Rating;
            $sb4->appraiser_remarks=$request->sectionB4Remarks;
            $sb4->save();

            if ($request->has('sectionC1Rating')){

                $sc1=AppraisalSectionResult::where('resultable_id',1)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc1->appraiser_rating=$request->sectionC1Rating;
                $sc1->appraiser_remarks=$request->sectionC1Remarks;
                $sc1->save();

                $sc2=AppraisalSectionResult::where('resultable_id',2)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc2->appraiser_rating=$request->sectionC2Rating;
                $sc2->appraiser_remarks=$request->sectionC2Remarks;
                $sc2->save();

                $sc3=AppraisalSectionResult::where('resultable_id',3)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc3->appraiser_rating=$request->sectionC3Rating;
                $sc3->appraiser_remarks=$request->sectionC3Remarks;
                $sc3->save();


                $sc4=AppraisalSectionResult::where('resultable_id',4)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc4->appraiser_rating=$request->sectionC4Rating;
                $sc4->appraiser_remarks=$request->sectionC4Remarks;
                $sc4->save();
            }


            $sd1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionD')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sd1->appraiser_remarks=$request->keyStrengthComment;
            $sd1->save();


            $sd2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionD')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sd2->appraiser_remarks=$request->keyStrengthComment;
            $sd2->save();




            $appraisal=Appraisal::find($request->appraisal_id);
            $appraisal->status='reviewed';

            if ( $appraisal->save()){

                return  response()->json([
                    'status'=>true,
                    'message'=>'Appraisal reviewed successfully'
                ]);

            }

            return  response()->json([
                'status'=>false,
                'message'=>'Appraisal not reviewed '
            ]);

        }
        else if ($employee->designation_id==17){


            $kra1=AppraisalSectionResult::where('resultable_id',8)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('employee_id',$request->employee_id)
                ->where('appraisal_id',$request->appraisal_id)
                ->first();
            $kra1->appraiser_rating=$request->sectionAKRA1;
            $kra1->appraiser_remarks=$request->sectionAKRA1Remarks;
            $kra1->save();

            $kra2=AppraisalSectionResult::where('resultable_id',9)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra2->appraiser_rating=$request->sectionAKRA2;
            $kra2->appraiser_remarks=$request->sectionAKRA2Remarks;
            $kra2->save();

            $kra3=AppraisalSectionResult::where('resultable_id',10)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra3->appraiser_rating=$request->sectionAKRA3;
            $kra3->appraiser_remarks=$request->sectionAKRA3Remarks;
            $kra3->save();

            $kra4=AppraisalSectionResult::where('resultable_id',11)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra4->appraiser_rating=$request->sectionAKRA4;
            $kra4->appraiser_remarks=$request->sectionAKRA4Remarks;
            $kra4->save();

            $kra5=AppraisalSectionResult::where('resultable_id',12)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra5->appraiser_rating=$request->sectionAKRA5;
            $kra5->appraiser_remarks=$request->sectionAKRA5Remarks;
            $kra5->save();

            $kra6=AppraisalSectionResult::where('resultable_id',13)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra6->appraiser_rating=$request->sectionAKRA6;
            $kra6->appraiser_remarks=$request->sectionAKRA6Remarks;
            $kra6->save();


            $sb1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb1->appraiser_rating=$request->sectionB1Rating;
            $sb1->appraiser_remarks=$request->sectionB1Remarks;
            $sb1->save();

            $sb2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb2->appraiser_rating=$request->sectionB2Rating;
            $sb2->appraiser_remarks=$request->sectionB2Remarks;
            $sb2->save();

            $sb3=AppraisalSectionResult::where('resultable_id',3)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb3->appraiser_rating=$request->sectionB3Rating;
            $sb3->appraiser_remarks=$request->sectionB3Remarks;
            $sb3->save();

            $sb4=AppraisalSectionResult::where('resultable_id',4)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb4->appraiser_rating=$request->sectionB4Rating;
            $sb4->appraiser_remarks=$request->sectionB4Remarks;
            $sb4->save();

            if ($request->has('sectionC1Rating')){

                $sc1=AppraisalSectionResult::where('resultable_id',1)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc1->appraiser_rating=$request->sectionC1Rating;
                $sc1->appraiser_remarks=$request->sectionC1Remarks;
                $sc1->save();

                $sc2=AppraisalSectionResult::where('resultable_id',2)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc2->appraiser_rating=$request->sectionC2Rating;
                $sc2->appraiser_remarks=$request->sectionC2Remarks;
                $sc2->save();

                $sc3=AppraisalSectionResult::where('resultable_id',3)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc3->appraiser_rating=$request->sectionC3Rating;
                $sc3->appraiser_remarks=$request->sectionC3Remarks;
                $sc3->save();


                $sc4=AppraisalSectionResult::where('resultable_id',4)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc4->appraiser_rating=$request->sectionC4Rating;
                $sc4->appraiser_remarks=$request->sectionC4Remarks;
                $sc4->save();
            }


            $sd1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionD')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sd1->appraiser_remarks=$request->keyStrengthComment;
            $sd1->save();


            $sd2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionD')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sd2->appraiser_remarks=$request->keyStrengthComment;
            $sd2->save();




            $appraisal=Appraisal::find($request->appraisal_id);
            $appraisal->status='reviewed';

            if ( $appraisal->save()){

                return  response()->json([
                    'status'=>true,
                    'message'=>'Appraisal reviewed successfully'
                ]);

            }

            return  response()->json([
                'status'=>false,
                'message'=>'Appraisal not reviewed '
            ]);

        }

        else if ($employee->designation_id==23){


            $kra1=AppraisalSectionResult::where('resultable_id',59)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('employee_id',$request->employee_id)
                ->where('appraisal_id',$request->appraisal_id)
                ->first();
            $kra1->appraiser_rating=$request->sectionAKRA1;
            $kra1->appraiser_remarks=$request->sectionAKRA1Remarks;
            $kra1->save();

            $kra2=AppraisalSectionResult::where('resultable_id',60)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra2->appraiser_rating=$request->sectionAKRA2;
            $kra2->appraiser_remarks=$request->sectionAKRA2Remarks;
            $kra2->save();

            $kra3=AppraisalSectionResult::where('resultable_id',61)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra3->appraiser_rating=$request->sectionAKRA3;
            $kra3->appraiser_remarks=$request->sectionAKRA3Remarks;
            $kra3->save();

            $kra4=AppraisalSectionResult::where('resultable_id',62)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra4->appraiser_rating=$request->sectionAKRA4;
            $kra4->appraiser_remarks=$request->sectionAKRA4Remarks;
            $kra4->save();

            $kra5=AppraisalSectionResult::where('resultable_id',63)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra5->appraiser_rating=$request->sectionAKRA5;
            $kra5->appraiser_remarks=$request->sectionAKRA5Remarks;
            $kra5->save();

            $sb1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb1->appraiser_rating=$request->sectionB1Rating;
            $sb1->appraiser_remarks=$request->sectionB1Remarks;
            $sb1->save();

            $sb2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb2->appraiser_rating=$request->sectionB2Rating;
            $sb2->appraiser_remarks=$request->sectionB2Remarks;
            $sb2->save();

            $sb3=AppraisalSectionResult::where('resultable_id',3)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb3->appraiser_rating=$request->sectionB3Rating;
            $sb3->appraiser_remarks=$request->sectionB3Remarks;
            $sb3->save();

            $sb4=AppraisalSectionResult::where('resultable_id',4)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb4->appraiser_rating=$request->sectionB4Rating;
            $sb4->appraiser_remarks=$request->sectionB4Remarks;
            $sb4->save();

            if ($request->has('sectionC1Rating')){

                $sc1=AppraisalSectionResult::where('resultable_id',1)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc1->appraiser_rating=$request->sectionC1Rating;
                $sc1->appraiser_remarks=$request->sectionC1Remarks;
                $sc1->save();

                $sc2=AppraisalSectionResult::where('resultable_id',2)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc2->appraiser_rating=$request->sectionC2Rating;
                $sc2->appraiser_remarks=$request->sectionC2Remarks;
                $sc2->save();

                $sc3=AppraisalSectionResult::where('resultable_id',3)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc3->appraiser_rating=$request->sectionC3Rating;
                $sc3->appraiser_remarks=$request->sectionC3Remarks;
                $sc3->save();


                $sc4=AppraisalSectionResult::where('resultable_id',4)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc4->appraiser_rating=$request->sectionC4Rating;
                $sc4->appraiser_remarks=$request->sectionC4Remarks;
                $sc4->save();
            }


            $sd1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionD')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sd1->appraiser_remarks=$request->keyStrengthComment;
            $sd1->save();


            $sd2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionD')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sd2->appraiser_remarks=$request->keyStrengthComment;
            $sd2->save();




            $appraisal=Appraisal::find($request->appraisal_id);
            $appraisal->status='reviewed';

            if ( $appraisal->save()){

                return  response()->json([
                    'status'=>true,
                    'message'=>'Appraisal reviewed successfully'
                ]);

            }

            return  response()->json([
                'status'=>false,
                'message'=>'Appraisal not reviewed '
            ]);

        }

        else if ($employee->designation_id==11){

            $kra1=AppraisalSectionResult::where('resultable_id',50)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('employee_id',$request->employee_id)
                ->where('appraisal_id',$request->appraisal_id)
                ->first();
            $kra1->appraiser_rating=$request->sectionAKRA1;
            $kra1->appraiser_remarks=$request->sectionAKRA1Remarks;
            $kra1->save();

            $kra2=AppraisalSectionResult::where('resultable_id',51)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra2->appraiser_rating=$request->sectionAKRA2;
            $kra2->appraiser_remarks=$request->sectionAKRA2Remarks;
            $kra2->save();

            $kra3=AppraisalSectionResult::where('resultable_id',52)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra3->appraiser_rating=$request->sectionAKRA3;
            $kra3->appraiser_remarks=$request->sectionAKRA3Remarks;
            $kra3->save();

            $kra4=AppraisalSectionResult::where('resultable_id',53)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra4->appraiser_rating=$request->sectionAKRA4;
            $kra4->appraiser_remarks=$request->sectionAKRA4Remarks;
            $kra4->save();



            $sb1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb1->appraiser_rating=$request->sectionB1Rating;
            $sb1->appraiser_remarks=$request->sectionB1Remarks;
            $sb1->save();

            $sb2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb2->appraiser_rating=$request->sectionB2Rating;
            $sb2->appraiser_remarks=$request->sectionB2Remarks;
            $sb2->save();

            $sb3=AppraisalSectionResult::where('resultable_id',3)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb3->appraiser_rating=$request->sectionB3Rating;
            $sb3->appraiser_remarks=$request->sectionB3Remarks;
            $sb3->save();

            $sb4=AppraisalSectionResult::where('resultable_id',4)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb4->appraiser_rating=$request->sectionB4Rating;
            $sb4->appraiser_remarks=$request->sectionB4Remarks;
            $sb4->save();

            if ($request->has('sectionC1Rating')){

                $sc1=AppraisalSectionResult::where('resultable_id',1)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc1->appraiser_rating=$request->sectionC1Rating;
                $sc1->appraiser_remarks=$request->sectionC1Remarks;
                $sc1->save();

                $sc2=AppraisalSectionResult::where('resultable_id',2)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc2->appraiser_rating=$request->sectionC2Rating;
                $sc2->appraiser_remarks=$request->sectionC2Remarks;
                $sc2->save();

                $sc3=AppraisalSectionResult::where('resultable_id',3)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc3->appraiser_rating=$request->sectionC3Rating;
                $sc3->appraiser_remarks=$request->sectionC3Remarks;
                $sc3->save();


                $sc4=AppraisalSectionResult::where('resultable_id',4)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc4->appraiser_rating=$request->sectionC4Rating;
                $sc4->appraiser_remarks=$request->sectionC4Remarks;
                $sc4->save();
            }


            $sd1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionD')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sd1->appraiser_remarks=$request->keyStrengthComment;
            $sd1->save();


            $sd2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionD')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sd2->appraiser_remarks=$request->keyStrengthComment;
            $sd2->save();




            $appraisal=Appraisal::find($request->appraisal_id);
            $appraisal->status='reviewed';

            if ( $appraisal->save()){

                return  response()->json([
                    'status'=>true,
                    'message'=>'Appraisal reviewed successfully'
                ]);

            }

            return  response()->json([
                'status'=>false,
                'message'=>'Appraisal not reviewed '
            ]);


        }
        else if ($employee->designation_id==10){

            $kra1=AppraisalSectionResult::where('resultable_id',19)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('employee_id',$request->employee_id)
                ->where('appraisal_id',$request->appraisal_id)
                ->first();
            $kra1->appraiser_rating=$request->sectionAKRA1;
            $kra1->appraiser_remarks=$request->sectionAKRA1Remarks;
            $kra1->save();

            $kra2=AppraisalSectionResult::where('resultable_id',20)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra2->appraiser_rating=$request->sectionAKRA2;
            $kra2->appraiser_remarks=$request->sectionAKRA2Remarks;
            $kra2->save();

            $kra3=AppraisalSectionResult::where('resultable_id',21)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra3->appraiser_rating=$request->sectionAKRA3;
            $kra3->appraiser_remarks=$request->sectionAKRA3Remarks;
            $kra3->save();

            $kra4=AppraisalSectionResult::where('resultable_id',22)
                ->where('resultable_type','App\Models\AppraisalSectionA')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $kra4->appraiser_rating=$request->sectionAKRA4;
            $kra4->appraiser_remarks=$request->sectionAKRA4Remarks;
            $kra4->save();



            $sb1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb1->appraiser_rating=$request->sectionB1Rating;
            $sb1->appraiser_remarks=$request->sectionB1Remarks;
            $sb1->save();

            $sb2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb2->appraiser_rating=$request->sectionB2Rating;
            $sb2->appraiser_remarks=$request->sectionB2Remarks;
            $sb2->save();

            $sb3=AppraisalSectionResult::where('resultable_id',3)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb3->appraiser_rating=$request->sectionB3Rating;
            $sb3->appraiser_remarks=$request->sectionB3Remarks;
            $sb3->save();

            $sb4=AppraisalSectionResult::where('resultable_id',4)
                ->where('resultable_type','App\Models\AppraisalSectionB')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sb4->appraiser_rating=$request->sectionB4Rating;
            $sb4->appraiser_remarks=$request->sectionB4Remarks;
            $sb4->save();

            if ($request->has('sectionC1Rating')){

                $sc1=AppraisalSectionResult::where('resultable_id',1)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc1->appraiser_rating=$request->sectionC1Rating;
                $sc1->appraiser_remarks=$request->sectionC1Remarks;
                $sc1->save();

                $sc2=AppraisalSectionResult::where('resultable_id',2)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc2->appraiser_rating=$request->sectionC2Rating;
                $sc2->appraiser_remarks=$request->sectionC2Remarks;
                $sc2->save();

                $sc3=AppraisalSectionResult::where('resultable_id',3)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc3->appraiser_rating=$request->sectionC3Rating;
                $sc3->appraiser_remarks=$request->sectionC3Remarks;
                $sc3->save();


                $sc4=AppraisalSectionResult::where('resultable_id',4)
                    ->where('resultable_type','App\Models\AppraisalSectionC')
                    ->where('appraisal_id',$request->appraisal_id)
                    ->where('employee_id',$request->employee_id)
                    ->first();
                $sc4->appraiser_rating=$request->sectionC4Rating;
                $sc4->appraiser_remarks=$request->sectionC4Remarks;
                $sc4->save();
            }


            $sd1=AppraisalSectionResult::where('resultable_id',1)
                ->where('resultable_type','App\Models\AppraisalSectionD')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sd1->appraiser_remarks=$request->keyStrengthComment;
            $sd1->save();


            $sd2=AppraisalSectionResult::where('resultable_id',2)
                ->where('resultable_type','App\Models\AppraisalSectionD')
                ->where('appraisal_id',$request->appraisal_id)
                ->where('employee_id',$request->employee_id)
                ->first();
            $sd2->appraiser_remarks=$request->keyStrengthComment;
            $sd2->save();




            $appraisal=Appraisal::find($request->appraisal_id);
            $appraisal->status='reviewed';

            if ( $appraisal->save()){

                return  response()->json([
                    'status'=>true,
                    'message'=>'Appraisal reviewed successfully'
                ]);

            }

            return  response()->json([
                'status'=>false,
                'message'=>'Appraisal not reviewed '
            ]);


        }

    }

    public function supervisor_review_appraisal(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'sectionAKRA1'=>'required',
            'sectionAKRA2'=>'required',

            'sectionAKRA3'=>'required',
            'sectionAKRA4'=>'required',

            'sectionAKRA5'=>'required',
            'sectionAKRA6'=>'required',

            'sectionAKRA7'=>'required',
            'sectionB1Rating'=>'required',

            'sectionB2Rating'=>'required',
            'sectionB3Rating'=>'required',

            'sectionB4Rating'=>'required',

            'sectionC1Rating'=>'required',
            'sectionC2Rating'=>'required',
            'sectionC3Rating'=>'required',
            'sectionC4Rating'=>'required',

            'employee_id'=>'required',
            'appraisal_id'=>'required'
        ]);

        if ($validator->fails()){
            return  response()->json([
                'status'=>false,
                'message'=>$validator->errors()->first()
            ]);
        }

        $user=User::find(auth()->user()->id);


        $kra1=AppraisalSectionResult::where('resultable_id',1)
            ->where('resultable_type','App\Models\AppraisalSectionA')
            ->where('employee_id',$request->employee_id)
            ->where('appraisal_id',$request->appraisal_id)
            ->first();
        $kra1->appraiser_rating=$request->sectionAKRA1;
        $kra1->appraiser_remarks=$request->sectionAKRA1Remarks;
        $kra1->save();

        $kra2=AppraisalSectionResult::where('resultable_id',2)
            ->where('resultable_type','App\Models\AppraisalSectionA')
            ->where('appraisal_id',$request->appraisal_id)
            ->where('employee_id',$request->employee_id)
            ->first();
        $kra2->appraiser_rating=$request->sectionAKRA2;
        $kra2->appraiser_remarks=$request->sectionAKRA2Remarks;
        $kra2->save();

        $kra3=AppraisalSectionResult::where('resultable_id',3)
            ->where('resultable_type','App\Models\AppraisalSectionA')
            ->where('appraisal_id',$request->appraisal_id)
            ->where('employee_id',$request->employee_id)
            ->first();
        $kra3->appraiser_rating=$request->sectionAKRA3;
        $kra3->appraiser_remarks=$request->sectionAKRA3Remarks;
        $kra3->save();

        $kra4=AppraisalSectionResult::where('resultable_id',4)
            ->where('resultable_type','App\Models\AppraisalSectionA')
            ->where('appraisal_id',$request->appraisal_id)
            ->where('employee_id',$request->employee_id)
            ->first();
        $kra4->appraiser_rating=$request->sectionAKRA4;
        $kra4->appraiser_remarks=$request->sectionAKRA4Remarks;
        $kra4->save();

        $kra5=AppraisalSectionResult::where('resultable_id',5)
            ->where('resultable_type','App\Models\AppraisalSectionA')
            ->where('appraisal_id',$request->appraisal_id)
            ->where('employee_id',$request->employee_id)
            ->first();
        $kra5->appraiser_rating=$request->sectionAKRA5;
        $kra5->appraiser_remarks=$request->sectionAKRA5Remarks;
        $kra5->save();

        $kra6=AppraisalSectionResult::where('resultable_id',6)
            ->where('resultable_type','App\Models\AppraisalSectionA')
            ->where('appraisal_id',$request->appraisal_id)
            ->where('employee_id',$request->employee_id)
            ->first();
        $kra6->appraiser_rating=$request->sectionAKRA6;
        $kra6->appraiser_remarks=$request->sectionAKRA6Remarks;
        $kra6->save();

        $kra7=AppraisalSectionResult::where('resultable_id',7)
            ->where('resultable_type','App\Models\AppraisalSectionA')
            ->where('appraisal_id',$request->appraisal_id)
            ->where('employee_id',$request->employee_id)
            ->first();
        $kra7->appraiser_rating=$request->sectionAKRA7;
        $kra7->appraiser_remarks=$request->sectionAKRA7Remarks;
        $kra7->save();


        $sb1=AppraisalSectionResult::where('resultable_id',1)
            ->where('resultable_type','App\Models\AppraisalSectionB')
            ->where('appraisal_id',$request->appraisal_id)
            ->where('employee_id',$request->employee_id)
            ->first();
        $sb1->appraiser_rating=$request->sectionB1Rating;
        $sb1->appraiser_remarks=$request->sectionB1Remarks;
        $sb1->save();

        $sb2=AppraisalSectionResult::where('resultable_id',2)
            ->where('resultable_type','App\Models\AppraisalSectionB')
            ->where('appraisal_id',$request->appraisal_id)
            ->where('employee_id',$request->employee_id)
            ->first();
        $sb2->appraiser_rating=$request->sectionB2Rating;
        $sb2->appraiser_remarks=$request->sectionB2Remarks;
        $sb2->save();

        $sb3=AppraisalSectionResult::where('resultable_id',3)
            ->where('resultable_type','App\Models\AppraisalSectionB')
            ->where('appraisal_id',$request->appraisal_id)
            ->where('employee_id',$request->employee_id)
            ->first();
        $sb3->appraiser_rating=$request->sectionB3Rating;
        $sb3->appraiser_remarks=$request->sectionB3Remarks;
        $sb3->save();

        $sb4=AppraisalSectionResult::where('resultable_id',4)
            ->where('resultable_type','App\Models\AppraisalSectionB')
            ->where('appraisal_id',$request->appraisal_id)
            ->where('employee_id',$request->employee_id)
            ->first();
        $sb4->appraiser_rating=$request->sectionB4Rating;
        $sb4->appraiser_remarks=$request->sectionB4Remarks;
        $sb4->save();

        $sc1=AppraisalSectionResult::where('resultable_id',1)
            ->where('resultable_type','App\Models\AppraisalSectionC')
            ->where('appraisal_id',$request->appraisal_id)
            ->where('employee_id',$request->employee_id)
            ->first();
        $sc1->appraiser_rating=$request->sectionC1Rating;
        $sc1->appraiser_remarks=$request->sectionC1Remarks;
        $sc1->save();

        $sc2=AppraisalSectionResult::where('resultable_id',2)
            ->where('resultable_type','App\Models\AppraisalSectionC')
            ->where('appraisal_id',$request->appraisal_id)
            ->where('employee_id',$request->employee_id)
            ->first();
        $sc2->appraiser_rating=$request->sectionC2Rating;
        $sc2->appraiser_remarks=$request->sectionC2Remarks;
        $sc2->save();

        $sc3=AppraisalSectionResult::where('resultable_id',3)
            ->where('resultable_type','App\Models\AppraisalSectionC')
            ->where('appraisal_id',$request->appraisal_id)
            ->where('employee_id',$request->employee_id)
            ->first();
        $sc3->appraiser_rating=$request->sectionC3Rating;
        $sc3->appraiser_remarks=$request->sectionC3Remarks;
        $sc3->save();


        $sc4=AppraisalSectionResult::where('resultable_id',4)
            ->where('resultable_type','App\Models\AppraisalSectionC')
            ->where('appraisal_id',$request->appraisal_id)
            ->where('employee_id',$request->employee_id)
            ->first();
        $sc4->appraiser_rating=$request->sectionC4Rating;
        $sc4->appraiser_remarks=$request->sectionC4Remarks;
        $sc4->save();


        $appraisal=Appraisal::find($request->appraisal_id);
        $appraisal->status='reviewed';
        if ( $appraisal->save()){

            return  response()->json([
                'status'=>true,
                'message'=>'Appraisal reviewed successfully'
            ]);

        }

        return  response()->json([
            'status'=>false,
            'message'=>'Appraisal not reviewed '
        ]);


    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appraisal  $appraisal
     * @return \Illuminate\Http\Response
     */
    public function show(Appraisal $appraisal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appraisal  $appraisal
     * @return \Illuminate\Http\Response
     */
    public function edit(Appraisal $appraisal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appraisal  $appraisal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appraisal $appraisal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appraisal  $appraisal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appraisal $appraisal)
    {
        //
    }
}
