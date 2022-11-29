@extends('layouts.smart-hr', ['title' => 'leaves'])
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
                        <a href="{{ route('export_leaves') }}" class="btn add-btn m-3">
                            <i class="fa fa-download"></i> Export records</a>
                        <a href="#" class="btn add-btn m-3" data-toggle="modal" data-target="#add_leave">
                            <i class="fa fa-plus"></i> Apply Leave</a>
                        <a href="{{ route('leave.applications') }}" class="btn add-btn m-3"><i class="fa fa-sign-out"></i>My
                            leaves</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Leave Statistics -->
            <div class="row">
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6> Total Employee Leaves</h6>
                        <h4>{{ count($leaves) ?? 0 }}</h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6>New Leaves Requests</h6>
                        <h4>{{ $leaves->where('status', '=', 'new')->count() ?? 0 }}</h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6>Approved Leaves</h6>
                        <h4>{{ $leaves->where('status', '=', 'Approved')->count() ?? 0 }}</h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6>Pending Requests</h6>
                        <h4>{{ $leaves->where('status', '=', 'Pending')->count() ?? 0 }}</h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6>Declined Requests</h6>
                        <h4>{{ $leaves->where('status', '=', 'Declined')->count() ?? 0 }}</h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6>Employees on leave</h6>
                        <h4>{{ $leaves->where('status', '=', 'Approved')->where('end_date', '>=', now())->count() ?? 0 }}<span>Currently</span>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- /Leave Statistics -->

            <!-- Search Filter -->
            <div class="row card filter-row">
                <div class="card-body">

                    <form action="{{ route('leaves_filter') }}" method="POST">
                        @csrf
                        @include('hrm.leaves.filter')
                    </form>
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
                                    <!-- <th>DOJ</th>
                                                <th>Tenure</th> -->
                                    <th>Project</th>
                                    {{-- <th>Project Type</th> --}}
                                    <th>Leave Type</th>
                                    <th>Date Range</th>
                                    {{-- <th>Leave End</th> --}}
                                    <th>Leave Days</th>
                                    <th>Leave Balance</th>
                                    <th class="text-center">Leave Status</th>
                                    <th> Approved by</th>

                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($leaves as $leave)
                                    <tr>
                                        <th>{{ $leave->employee->sap }}</th>

                                        <td>
                                            <h2 class="table-avatar">
                                                {{-- <span class="avatar text-light">1234</span> --}}
                                                <a href="{{ route('leaves.statistics', $leave->employee) }}">{{ $leave->employee->name }}
                                                    <span>{{ $leave->employee->designation->name }}</span></a>
                                            </h2>
                                        </td>
                                        {{-- <!-- <td>{{$leave->employee->contract_start}}</td> --> --}}
                                        {{-- <!-- <td>{{\Carbon\Carbon::parse(now())->diffForHumans($leave->employee->contract_start, true)}} </td> --> --}}
                                        <td>
                                            <h2 class="table-avatar">
                                                <a
                                                    href="{{ route('projects.show', $leave->employee->project) }}">{{ $leave->employee->project ? $leave->employee->project->name : 'NA' }}<span>{{ $leave->employee->project->project_type ? $leave->employee->project->project_type->name : 'NA' }}</span></a>
                                            </h2>
                                        </td>
                                        <td>{{ $leave->leave_category->name }}</td>
                                        {{-- <td>{{$leave->leave_days}}</td> --}}
                                        <td>{{ $leave->start_date->format('d M') }} <strong>-</strong>
                                            {{ $leave->end_date->format('d M') }}</td>
                                        <td>{{ $leave->num_days }}</td>

                                        {{-- <!-- <td>{{$leave->employee->designation->name}}</td> --> --}}
                                        {{-- <!-- <td>{{$leave->employee->project->project_type->name}}</td> --> --}}
                                        <td>{{ $leave->balance->balance ?? 'N/A' }}</td>
                                        <td class="text-center">
                                            <div class="dropdown action-label">
                                                @if (\Illuminate\Support\Facades\Auth::user()->id == $leave->employee->id)
                                                    @if (strtolower($leave->status) == 'new')
                                                        <i class="fa fa-dot-circle-o text-purple"></i> {{ $leave->status }}
                                                    @elseif (strtolower($leave->status) == 'pending')
                                                        <i class="fa fa-dot-circle-o text-info"></i> {{ $leave->status }}
                                                    @elseif (strtolower($leave->status) == 'approved')
                                                        <i class="fa fa-dot-circle-o text-success"></i>
                                                        {{ $leave->status }}
                                                    @elseif (strtolower($leave->status) == 'declined')
                                                        <i class="fa fa-dot-circle-o text-danger"></i> {{ $leave->status }}
                                                    @endif
                                                @else
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                        href="#" data-toggle="dropdown" aria-expanded="false">
                                                        @if (strtolower($leave->status) == 'new')
                                                            <i class="fa fa-dot-circle-o text-purple"></i>
                                                            {{ $leave->status }}
                                                        @elseif (strtolower($leave->status) == 'pending')
                                                            <i class="fa fa-dot-circle-o text-info"></i>
                                                            {{ $leave->status }}
                                                        @elseif (strtolower($leave->status) == 'approved')
                                                            <i class="fa fa-dot-circle-o text-success"></i>
                                                            {{ $leave->status }}
                                                        @elseif (strtolower($leave->status) == 'declined')
                                                            <i class="fa fa-dot-circle-o text-danger"></i>
                                                            {{ $leave->status }}
                                                        @endif
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item " href="#"><i
                                                                class="fa fa-dot-circle-o text-purple"></i> New</a>
                                                        <a class="dropdown-item status-btn" href="#"
                                                            data-toggle="modal" data-target="#approve_leave"
                                                            data-id="{{ $leave->id }}" data-status="Pending"><i
                                                                class="fa fa-dot-circle-o text-info"></i> Pending</a>
                                                        <a class="dropdown-item status-btn" href="#"
                                                            data-toggle="modal" data-target="#approve_leave"
                                                            data-id="{{ $leave->id }}" data-status="Approved"><i
                                                                class="fa fa-dot-circle-o text-success"></i> Approved</a>
                                                        <a class="dropdown-item status-btn" href="#"
                                                            data-toggle="modal" data-target="#approve_leave"
                                                            data-id="{{ $leave->id }}" data-status="Declined"><i
                                                                class="fa fa-dot-circle-o text-danger"></i> Declined</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $leave->approved_by->name ?? 'N/A' }}</td>

                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#edit_leave{{ $leave->id }}"><i
                                                            class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a id="delete_approve_btn" data-id="{{ $leave->id }}"
                                                        class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                @empty
                                    <span> - </span>
                                @endforelse

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
                        <form method="post" action="{{ route('leaves.store') }}">
                            @include('hrm.leaves.leave_app_form')
                        </form>
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
                        <form id="approve_leave_form" method='POST'>
                            @csrf
                            <div class="form-header">
                                <h3>Leave Status</h3>
                                <p>Are you sure want to update status for this leave?</p>
                            </div>
                            <input type="text" hidden name="leave_id" id="leave_id">
                            {{-- <input type="text" hidden name="status" value='Approved'> --}}
                            @role('Team Coordinator')
                                @if($members->flatMap->leaves->where('leave_category_id', 1)->where('status', 'Approved')->where('end_date', '>=', now())->count() >= $pCount)
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Cannot exceed Leave Threshold!.</strong>
                                  </div>
                                {{-- <div class="alert alert-danger" role="alert"> Cannot exceed Leave Threshold! </div> --}}
                                @endif
                            @endrole
                            <div class="form-group">
                                <label>Status <span class="text-danger ">*</span></label>
                                <select id="new_status" class="form-control @error('new_status') is-invalid @enderror"
                                    required name="new_status">
                                    @role('Team Coordinator')
                                    @if($members->flatMap->leaves->where('leave_category_id', 1)->where('status', '=', 'Approved')->where('end_date', '>=', now())->count() >= $pCount)
                                    <option value="Declined">Declined</option>
                                    <option value="Pending">Pending</option>
                                    @else
                                    <option value="Declined">Declined</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Pending">Pending</option>
                                    @endif
                                    @endrole
                                </select>
                                @error('new_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Comments <span class="text-danger">*</span></label>
                                <textarea rows="4" class="form-control @error('comments') is-invalid @enderror" name="comments" required>{{ old('comments', '') }}</textarea>
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
                                        <a href="javascript:void(0);" data-dismiss="modal"
                                            class="btn btn-primary cancel-btn">Cancel</a>
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
                        <form id="delete-leave-modal" method="POST">
                            {{-- <form action="{{route('leaves.destroy', $leave)}}" method="POST"> --}}
                            @method('DELETE')
                            @csrf
                            <div class="form-header">
                                <h3>Delete Leave</h3>
                                <p>Are you sure want to delete this leave?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary submit-btn">Delete</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal"
                                            class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Leave Modal -->

        <!-- Edit Leave Modal -->
        <div id="edit_leave" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Leave</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="leave-update-form">
                            @include('hrm.leaves.leave_app_form')
                            @csrf
                            @method('PUT')
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Leave Modal -->

    </div>
    <!-- /Page Wrapper -->
@endsection
@section('custom_js')
    <script>
        $(document).on("click", ".status-btn", function(e) {
            var status = $(this).data('status');
            var leave_id = $(this).data('id');
            $('#approve_leave_form').attr('action', "/approveleave/" + leave_id);
            $('#new_status').value = status;

        });
        $(document).on('click', '#delete_approve_btn', function(e) {
            var leave_id = $(this).data('id');
            $('#delete-leave-modal').attr('action', "/leaves/" + leave_id);
        });
    </script>
@endsection
