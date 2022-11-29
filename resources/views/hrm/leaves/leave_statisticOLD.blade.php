@extends('layouts.smart-hr', ['title' => 'Leaves'])
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Leave Balances</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">leaves</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="card-body">
                    <div class="justify-content-center">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Annual Leave</th>
                                    <th>Sick Leave</th>
                                    <th>Compassionate Leave</th>
                                    <th>Maternity Leave</th>
                                    <th>Paternity Leave</th>
                                </tr>

                            </thead>

                            <tr>
                                {{-- <td>{{$leave->employee->leave_balances()->where('record_year',now())->where('leave_category_id',1)->pluck('balance')->first()}}</td> --}}
                                <td>{{$leave->employee->leave_balances()->where('record_year', '=', now())->whereHas('leave_category', fn($q)=>$q->where('name', 'like','%annual%'))->pluck('balance')->first() ?? '21'}}<span> Days</span></td>
                                <td>{{$leave->employee->leave_balances()->where('record_year', '=', now())->whereHas('leave_category', fn($q)=>$q->where('name', 'like','%sick%'))->pluck('balance')->first() ?? '10'}}<span> Days</span></td>
                                <td>{{$leave->employee->leave_balances()->where('record_year', '=', now())->whereHas('leave_category', fn($q)=>$q->where('name', 'like','%compassionate%'))->pluck('balance')->first() ?? '5'}}<span> Days</span></td>
                                <td>{{$leave->employee->leave_balances()->where('record_year', '=', now())->whereHas('leave_category', fn($q)=>$q->where('name', 'like','%maternity%'))->pluck('balance')->first() ?? '90'}}<span> Days</span></td>
                                <td>{{$leave->employee->leave_balances()->where('record_year', '=', now())->whereHas('leave_category', fn($q)=>$q->where('name', 'like','%paternity%'))->pluck('balance')->first() ?? '14'}}<span> Days</span></td>

                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
