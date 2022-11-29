@extends('layouts.smart-hr', ['title'=>'leaves'])
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        @include('layouts.partials.flash')
        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Leaves</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                            <li class="breadcrumb-item active">Leaves</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
						<a href="{{route('export_leaves')}}" class="btn add-btn m-3" ><i class="fa fa-download"></i> Export records</a>

                        <a href="#" class="btn add-btn m-3" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Apply Leave</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Leave Statistics -->
            <div class="row">
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6> Total Employees</h6>
                        <h4>{{count($leaves)}}</h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6>New Leaves Requests</h6>
                        <h4>8 <span>Today</span></h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6>Approved Leaves</h6>
                        <h4>0 <span>Today</span></h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6>Pending Requests</h6>
                        <h4>12</h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6>Declined Requests</h6>
                        <h4>12</h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6>Employees on leave</h6>
                        <h4>12 <span>Currently</span></h4>
                    </div>
                </div>
            </div>
            <!-- /Leave Statistics -->

            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Employee sap</label>
                        </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <div class="form-group form-focus select-focus">
                            <select class="select floating">
                                <option> -- Select -- </option>
                                <option>Casual Leave</option>
                                <option>Medical Leave</option>
                                <option>Loss of Pay</option>
                            </select>
                            <label class="focus-label">Leave Type</label>
                        </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <div class="form-group form-focus select-focus">
                            <select class="select floating">
                                <option> -- Select -- </option>
                                <option> Pending </option>
                                <option> Approved </option>
                                <option> Declined </option>
                            </select>
                            <label class="focus-label">Leave Status</label>
                        </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <div class="form-group form-focus">
                            <div class="cal-icon datetime">
                                <input class="form-control floating datetimepicker from" type="text">
                            </div>
                            <label class="focus-label">From</label>
                        </div>
                    </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text">
                            </div>
                            <label class="focus-label">To</label>
                        </div>
                    </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <a href="#" class="btn btn-success btn-block"> Search </a>
                </div>
            </div>
            <!-- /Search Filter -->

            <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0 datatable">
                        <thead>
                            <tr>
                                <th>SAP</th>
                                <th>Employee</th>
                                <th>DOJ</th>
                                <th>Tenure</th>
                                <th>Project</th>
                                <th>Designation</th>
                                <th>Project Type</th>
                                <th>Leave Balance</th>
                                <th>Leave Type</th>
                                <th class="text-center">Leave Status</th>

                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaves as $leave)
                            <tr>
                                <td>{{$leave->employee->sap}}</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="profile" class="avatar"><img alt="" src="img/profiles/avatar-09.jpg"></a>
                                        <a href="#">{{$leave->employee->first_name." ".$leave->employee->other_names}} <span>{{$leave->employee->designation->name}}</span></a>
                                    </h2>
                                </td>
                                <td>{{$leave->employee->contract_start}}</td>
                                <td>{{\Carbon\Carbon::parse(now())->diffForHumans($leave->employee->contract_start, true)}} </td>
                                <td>{{$leave->employee->project->name}}</td>
                                <td>{{$leave->employee->designation->name}}</td>
                                <td>{{$leave->employee->project->project_type->name}}</td>
                                <td>{{$leave->employee->leave_balances->toQuery()->where('record_year', now()->format('Y'))->where('leave_category_id', $leave->leave_category->id)->first()->balance}}</td>
                                <td>{{$leave->cat->name}}</td>
                                <td class="text-center">
                                    <div class="dropdown action-label">
                                        @if(\Illuminate\Support\Facades\Auth::user()->id ==$leave->employee->id)
                                        @if (strtolower($leave->status)=='new')
                                        <i class="fa fa-dot-circle-o text-purple"></i> {{$leave->status}}
                                        @elseif (strtolower($leave->status)=='pending')
                                        <i class="fa fa-dot-circle-o text-info"></i> {{$leave->status}}
                                        @elseif (strtolower($leave->status)=='approved')
                                        <i class="fa fa-dot-circle-o text-success"></i> {{$leave->status}}
                                        @elseif (strtolower($leave->status)=='declined')
                                        <i class="fa fa-dot-circle-o text-danger"></i> {{$leave->status}}
                                        @endif
                                        @else
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            @if (strtolower($leave->status)=='new')
                                            <i class="fa fa-dot-circle-o text-purple"></i> {{$leave->status}}
                                            @elseif (strtolower($leave->status)=='pending')
                                            <i class="fa fa-dot-circle-o text-info"></i> {{$leave->status}}
                                            @elseif (strtolower($leave->status)=='approved')
                                            <i class="fa fa-dot-circle-o text-success"></i> {{$leave->status}}
                                            @elseif (strtolower($leave->status)=='declined')
                                            <i class="fa fa-dot-circle-o text-danger"></i> {{$leave->status}}
                                            @endif
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item " href="#"><i class="fa fa-dot-circle-o text-purple"></i> New</a>
                                            <a class="dropdown-item status-btn" href="#" data-toggle="modal" data-target="#approve_leave" data-id="{{$leave->id}}" data-status="Pending"><i class="fa fa-dot-circle-o text-info"></i> Pending</a>
                                            <a class="dropdown-item status-btn" href="#" data-toggle="modal" data-target="#approve_leave" data-id="{{$leave->id}}" data-status="Approved"><i class="fa fa-dot-circle-o text-success"></i> Approved</a>
                                            <a class="dropdown-item status-btn" href="#" data-toggle="modal" data-target="#approve_leave" data-id="{{$leave->id}}" data-status="Declined"><i class="fa fa-dot-circle-o text-danger"></i> Declined</a>
                                        </div>
                                        @endif
                                    </div>
                                </td>

                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_leave{{$leave->id}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Leave Modal -->
                            <div id="edit_leave{{$leave->id}}" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Leave</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{route('leaves.update',$leave->id)}}">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <select class="select @error ('leave_cat') is-invalid @enderror" required name="leave_cat">
                                                        <option selected value="{{old('leave_cat', '')}}">{{old('leave_cat', 'Select Leave Type')}}</option>
                                                        @foreach ($cats as $cat )
                                                        <option value={{"$cat->id"}} {{$cat->id == $leave->leave_category_id ? 'Selected' : ''}}>{{$cat->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>From <span class="text-danger">*</span></label>
                                                    <div class="cal-icon">
                                                        <input class="form-control " value="{{$leave->start_date}}" type="date" name="date_from">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="cal-icon">
                                                        <input class="form-control " value="{{$leave->employee_id}}" type="hidden" name="employee_id">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>To <span class="text-danger">*</span></label>
                                                    <div class="cal-icon">
                                                        <input class="form-control " value="{{$leave->end_date}}" type="date" name="date_to">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Number of days <span class="text-danger">*</span></label>
                                                    <input class="form-control" readonly type="text" value="{{$leave->days}}" name="days">
                                                </div>
                                                <div class="form-group">
                                                    <label>Leave Reason <span class="text-danger">*</span></label>
                                                    <textarea rows="4" class="form-control" name="reason">{{$leave->reason}}</textarea>
                                                </div>
                                                <div class="submit-section">
                                                    <button class="btn btn-primary submit-btn">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Edit Leave Modal -->

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        <!-- /Page Content -->

        <!-- Add Leave Modal -->
        <div id="add_leave" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Apply for Leave</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('hrm.leaves.leave_app_form')
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Leave Modal -->



        <!-- Approve Leave Modal -->
        <div class="modal custom-modal fade" id="approve_leave" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{route('approveleave')}}" method='POST'>
                            @csrf
                            <div class="form-header">
                                <h3>Leave Status</h3>
                                <p>Are you sure want to update status for this leave?</p>
                            </div>
                            <input type="text" hidden name="leave_id" id="leave_id">
                            {{-- <input type="text" hidden name="status" value='Approved'> --}}

                            <div class="form-group">
                                <label>Status <span class="text-danger ">*</span></label>
                                <select id="new_status" class="form-control @error ('new_status') is-invalid @enderror" required name="new_status">
                                    <option  value="Declined">Declined</option>
                                    <option value="Approved">Approved</option>
                                    <option  value="Pending">Pending</option>
                                </select>
                                @error('new_status')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
                            </div>
                            <div class="form-group">
                                <label>Comments <span class="text-danger">*</span></label>
                                <textarea rows="4" class="form-control @error ('comments') is-invalid @enderror" name="comments" required>{{old('comments', '')}}</textarea>
                                @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary continue-btn">Update</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Approve Leave Modal -->

        <!-- Delete Leave Modal -->
        <div class="modal custom-modal fade" id="delete_approve" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Leave</h3>
                            <p>Are you sure want to delete this leave?</p>
                            <label>
                                Calendar
                                <input id="calendar" mbsc-input placeholder="Please select..." />
                            </label>
                            <div class="input-group date" data-provide="datepicker">
                                <input  class="form-control dt">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Leave Modal -->

    </div>
    <!-- /Page Wrapper -->
@endsection
@section('custom_js')
<script>

    $(document).on("click", ".status-btn", function () {
        var status = $(this).data('status');
        var id = $(this).data('id');
        document.getElementById('new_status').value=status;
        document.getElementById('leave_id').value=id;

    });

</script>
@endsection
