@extends('layouts.smart-hr', ['title' => 'Leaves'])
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
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i
                                class="fa fa-plus"></i> Apply Leave</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Leave Statistics -->

            <div class="row">
                {{-- @foreach ($leaves as $leave) --}}
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>AL</h6>
                        <h4>{{ Auth::user()->employee->leave_balances()->where('record_year', Carbon\Carbon::now()->format('Y'))->whereHas('leave_category', fn($q) => $q->where('name', 'like', '%annual%'))->pluck('balance')->first() ?? '21' }}
                        </h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>SL</h6>
                        <h4>{{ Auth::user()->employee->leave_balances()->where('record_year', Carbon\Carbon::now()->format('Y'))->whereHas('leave_category', fn($q) => $q->where('name', 'like', '%sick%'))->pluck('balance')->first() ?? '10' }}
                        </h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>CL</h6>
                        <h4>{{ Auth::user()->employee->leave_balances()->where('record_year', Carbon\Carbon::now()->format('Y'))->whereHas('leave_category', fn($q) => $q->where('name', 'like', '%compassionate%'))->pluck('balance')->first() ?? '5' }}
                        </h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-info">
                        @if (Str::contains(Str::lower(Auth::user()->employee->gender->name), 'female'))
                            <h6>ML</h6>
                            <h4>{{ Auth::user()->employee->leave_balances()->where('record_year', Carbon\Carbon::now()->format('Y'))->whereHas('leave_category', fn($q) => $q->where('name', 'like', '%maternity%'))->pluck('balance')->first() ?? '90' }}
                            </h4>
                        @else
                            <h6>PL</h6>
                            <h4>{{ Auth::user()->employee->leave_balances()->where('record_year', Carbon\Carbon::now()->format('Y'))->whereHas('leave_category', fn($q) => $q->where('name', 'like', '%paternity%'))->pluck('balance')->first() ?? '14' }}
                            </h4>
                        @endif
                    </div>
                </div>
                {{-- @endforeach --}}
            </div>
            <!-- /Leave Statistics -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>Applied on</th>
                                    <th>Leave Type</th>
                                    <th>Leave Start</th>
                                    <th>Leave End</th>
                                    <th>Leave Days</th>
                                    <th>Leave Balance</th>
                                    <th class="text-center">Leave Status</th>
                                    <th>Approved By</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($leaves as $leave)
                                <tr>
                                    <td>{{ $leave->created_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ $leave->leave_category->name }}</td>
                                    {{-- <td>{{$leave->leave_days}}</td> --}}
                                    <td>{{ $leave->start_date->format('Y-m-d') }}</td>
                                    <td>{{ $leave->end_date->format('Y-m-d') }}</td>
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
                                    <td>{{($leave->approved_by) ? $leave->approved_by->name : ''}}</td>
                                    <td>{{$leave->comments}}</td>
                                </tr>

                                    <!-- Edit Leave Modal -->
                                    <div id="edit_leave{{ $leave->id }}" class="modal custom-modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Leave</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('leaves.update', $leave->id) }}">
                                                        @include('hrm.leaves.leave_app_form')
                                                        @csrf
                                                        @method('PUT')
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Edit Leave Modal -->
                                    @empty
                                        No records.
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

        <!-- Edit Leave Modal -->
        <!-- /Edit Leave Modal -->

        <!-- Delete Leave Modal -->
        <div class="modal custom-modal fade" id="delete_approve" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Leave</h3>
                            <p>Are you sure want to Cancel this leave?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal"
                                        class="btn btn-primary cancel-btn">Cancel</a>
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
