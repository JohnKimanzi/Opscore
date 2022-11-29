<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;
use Illuminate\Support\Facades\Redirect;


class LeaveBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->store_multiple(2021);
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
     * Create multiple records.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_multiple($year = 2022)
    {
        foreach (Employee::all() as $employee) {
            foreach (LeaveCategory::all() as $cat) {
                LeaveBalance::create([
                    'employee_id' => $employee->id,
                    'record_year' => $year,
                    'consumed' => 0,
                    'leave_category_id' => $cat->id,
                    'balance' => $cat->num_days,
                    'carried_forward' => 0
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LeaveBalance  $leaveBalance
     * @return \Illuminate\Http\Response
     */
    public function show(LeaveBalance $leaveBalance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LeaveBalance  $leaveBalance
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveBalance $leaveBalance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LeaveBalance  $leaveBalance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaveBalance $leaveBalance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LeaveBalance  $leaveBalance
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveBalance $leaveBalance)
    {
        //
    }
}
