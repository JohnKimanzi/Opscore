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
            <table class="table custom-table mb-0 table-striped custom-data-table flex-fill">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Leave Type</th>
                        <th>Carried Forward</th>
                        <th>Entitled</th>
                        <th>Accrued</th>
                        <th>Utilized</th>
                        <th>Balance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leave_categories as $leave_cat)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $leave_cat->name }}</td>
                            @php
                                $lb = $employee
                                    ->leave_balances()
                                    ->where('record_year', \Carbon\Carbon::now()->format('Y'))
                                    ->where('leave_category_id', $leave_cat->id)
                                    ->first();
                            @endphp
                            <td>{{ $lb ? $lb->carried_forward : 'N/A' }}</td>
                            <td>{{ $leave_cat->num_days }}</td>
                            <td>
                                @if (Str::contains(strtolower($leave_cat->name), 'annual'))
                                    {{ floor(Carbon\Carbon::now()->format('m')*1.75) + $lb->carried_forward }}
                                @else
                                    {{ $leave_cat->num_days }}
                                @endif
                            </td>
                            <td>{{ $lb ? $lb->consumed : 0 }}</td>
                            <td>{{ $lb ? $lb->balance : $leave_cat->num_days }}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button id="edit_leave_bal_btn" class="dropdown-item"
                                            data-toggle="modal"
                                            data-num="{{ $lb ? $lb->balance : $leave_cat->num_days }}"
                                            @if($lb && Str::contains(Str::lower($leave_cat->name), 'annual' )) data-cf="{{$lb->carried_forward}}" @endif
                                            data-bal_id='{{ $lb ? $lb->id : null }}'
                                            data-cat_id='{{ $leave_cat->id }}'
                                            data-emp_id='{{ $employee->id }}'
                                            data-target="#edit_leave_stat">
                                            <i class="fa fa-pencil m-r-5"></i> Edit</button>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!--Edit Leave Stat-->
            <div id="edit_leave_stat" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Leave Balance</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="edit_leave_stat_form" action="{{route('edit_leavestat')}}" method="POST">
                                @csrf
                                <input type="text" id="employee_id_input" name="employee_id" value="{{ $employee->id }}"class='form-control'
                                    hidden>
                                    <input type="text" id="bal_id_input" name="bal_id" value="{{ $employee->id }}"class='form-control'
                                    hidden>
                                <input type="text" id="leave_cat_id_input" name="leave_category_id"
                                    value="{{ old('leave_category_id') }}"class='form-control' hidden>
                                <div class="form-group">
                                    <label for="balance">New Balance</label>
                                    <input id="new_bal_input" type="number" name="balance" value="{{ old('balance') }}"
                                        class='form-control'>
                                </div>
                                <div class="form-group">
                                    <label for="carried_forward">Carried Forward</label>
                                    <input id="carried_forward_input" type="number" name="carried_forward" value="{{ old('carried_forward') }}"
                                        class='form-control'>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    <button type="submit" value="submit" class="btn btn-success ">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Leave Stat-->
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('body').on('click', '#edit_leave_bal_btn', function() {
            let carried_foward = $(this).data('cf')
            let days = $(this).data('num');
            var leave_bal_id = $(this).data('bal_id');
            if(carried_foward){
                $("#edit_leave_stat #carried_forward_input").val(carried_foward);
            }else{
                $("#edit_leave_stat #carried_forward_input").attr('disabled', true);
            }
            $("#edit_leave_stat #new_bal_input").val(days);
            $("#edit_leave_stat #employee_id_input").val($(this).data('emp_id'));
            $("#edit_leave_stat #leave_cat_id_input").val($(this).data('cat_id'));
            $("#edit_leave_stat #bal_id_input").val($(this).data('bal_id'));


        });
    </script>
@endpush
