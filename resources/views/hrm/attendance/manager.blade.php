@extends('layouts.smart-hr')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        @include('layouts.partials.flash')
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Attendance  @isset($end_date, $start_date)
                                <small>Records Between {{$start_date->format('d M Y')}} and {{$end_date->format('d M Y')}}</small>
                            @endisset</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Attendance</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <form action="attendance_filter" method="POST">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="flt_sap">
                            <label class="focus-label">Employee SAP ID</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-12">
                        <div class="form-group form-focus">
                            <div >
                                <input class="form-control floating " type="date" name="flt_from">
                            </div>
                            <label class="focus-label">From</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-12">
                        <div class="form-group form-focus">
                            <div >
                                <input class="form-control floating " type="date" name="flt_to">
                            </div>
                            <label class="focus-label">To</label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <button href="#" class="btn btn-success btn-block"> Search </button>
                    </div>
                </div>
            </form>
            <!-- /Search Filter -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                    <table id="table" class="table table-striped custom-table mb-0 datatable">
                    {{-- <div class="table-responsive">
                        <table id="table" class="table table-striped custom-table table-nowrap mb-0 attendance-table"> --}}
                            <thead>
                            <tr>
                                <th style="position:sticky">Employee</th>
                                @php
                                    // $date_today = '2021-09';

                                        $start=$start_date->copy();
                                        // $start1=$start_date;
                                        $end=$end_date;
                                        // echo $start_date->format('Y-m-d');


                                    // dd($end->format('d'));
                                    $dates = [];
                                    while ($start->lte($end) ) {
                                        $dates[] = $start->copy();
                                        echo '<th>'.$start->format('d').' <br>'.$start->format('D').' </th>';
                                        $start->addDay();
                                    }

                                @endphp

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td style="position:sticky">
                                        <h2 class="table-avatar">
                                            {{-- <a class="avatar avatar-xs" href="profile.html"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a> --}}
                                            <a href="{{route('employees.show', $employee)}}">{{$employee->first_name." ".$employee->other_names}}</a>
                                        </h2>
                                    </td>
                                    @php
                                        $start=$start_date->copy();
                                        // echo $start1->format('Y-m-d');
                                    @endphp

                                    @while($start->lte($end_date))

                                        @php($attendances=$employee->attendances()->wheredate('record_date', $start))
                                        <td style="text-align: center">
                                            <a class='attendance-btn' href='' data-toggle='modal'
                                               data-target='#mark-attendance'
                                               data-employee='{{$employee->id}}'
                                               data-day='{{$start->format('Y-m-d')}}'>
                                                @php($a=$attendances->first())

                                                @if ($attendances->count()==0)
                                                    <i class="fa fa-minus text-dark "></i>

                                                @elseif (strtolower($a->status)=='present')
                                                    <div class=" text-white bg-success">P</div>

                                                @elseif (strtolower($a->status)=='absent')
                                                    <div class=" text-white bg-danger">A</div>
                                                @elseif (strtolower($a->status)=='sick off')
                                                    <div class=" text-white bg-danger">SO</div>

                                                @elseif (strtolower($a->status)=='week off')
                                                    <div class=" text-white bg-info">WO</div>
                                                @elseif (strtolower($a->status)=='al')
                                                    <div class=" text-white bg-info">L</div>
                                                @elseif (strtolower($a->status)=='ml')
                                                    <div class="text-white" style="background-color: brown">ML</div>
                                                @elseif (strtolower($a->status)=='pl')
                                                    <div class=" text-white" style="background-color: rebeccapurple">PL</div>
                                                @elseif (strtolower($a->status)=='cl')
                                                    <div class="text-white" style="background-color: hotpink">CL</div>
                                                @elseif (strtolower($a->status)=='holiday')
                                                    <div class=" text-white bg-info">H</div>

                                                @elseif (strtolower($a->status)=='halfday')
                                                    <div class=" text-white bg-warning">HD</div>
                                            </a>

                                            @else
                                                <i class="fa fa-exclamation text-warning"></i>
                                                @endif
                                                </a>
                                        </td>
                                        @php($start->addDay())
                                    @endwhile
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Attendance Modal -->
        <div class="modal custom-modal fade" id="attendance-info" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Attendance Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card punch-status">
                                    <div class="card-body">
                                        <h5 class="card-title">Timesheet <small class="text-muted">11 Mar 2019</small></h5>
                                        <div class="punch-det">
                                            <h6>Punch In at</h6>
                                            <p>Wed, 11th Mar 2019 10.00 AM</p>
                                        </div>
                                        <div class="punch-info">
                                            <div class="punch-hours">
                                                <span>3.45 hrs</span>
                                            </div>
                                        </div>
                                        <div class="punch-det">
                                            <h6>Punch Out at</h6>
                                            <p>Wed, 20th Feb 2019 9.00 PM</p>
                                        </div>
                                        <div class="statistics">
                                            <div class="row">
                                                <div class="col-md-6 col-6 text-center">
                                                    <div class="stats-box">
                                                        <p>Break</p>
                                                        <h6>1.21 hrs</h6>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6 text-center">
                                                    <div class="stats-box">
                                                        <p>Overtime</p>
                                                        <h6>3 hrs</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card recent-activity">
                                    <div class="card-body">
                                        <h5 class="card-title">Activity</h5>
                                        <ul class="res-activity-list">
                                            <li>
                                                <p class="mb-0">Punch In at</p>
                                                <p class="res-activity-time">
                                                    <i class="fa fa-clock-o"></i>
                                                    10.00 AM.
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0">Punch Out at</p>
                                                <p class="res-activity-time">
                                                    <i class="fa fa-clock-o"></i>
                                                    11.00 AM.
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0">Punch In at</p>
                                                <p class="res-activity-time">
                                                    <i class="fa fa-clock-o"></i>
                                                    11.15 AM.
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0">Punch Out at</p>
                                                <p class="res-activity-time">
                                                    <i class="fa fa-clock-o"></i>
                                                    1.30 PM.
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0">Punch In at</p>
                                                <p class="res-activity-time">
                                                    <i class="fa fa-clock-o"></i>
                                                    2.00 PM.
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0">Punch Out at</p>
                                                <p class="res-activity-time">
                                                    <i class="fa fa-clock-o"></i>
                                                    7.30 PM.
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Attendance Modal -->

        @can('Manage Attendance')
        <!-- Mark attendance Atendance Modal -->
            <div class="modal custom-modal fade" id="mark-attendance" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="{{route('attendance.store')}}" method='POST'>
                                @csrf
                                <div class="form-header">
                                    <h3>Mark attendance</h3>
                                </div>

                                <div class="form-group">
                                    <label class="text-info">Employee <span class="text-danger ">*</span></label>
                                    <select  id="employee_id" class="form-control @error ('employee_id') is-invalid @enderror" required name="employee_id">
                                        @foreach ($employees as $employee)
                                            <option  value="{{$employee->id}}">{{$employee->first_name}} {{$employee->middle_name}} {{$employee->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                    <span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Status <span class="text-danger ">*</span></label>
                                    <select id="status" class="form-control @error ('status') is-invalid @enderror" required name="status">
                                        <option  value="present">Present</option>
                                        <option  value="halfday">Half Day</option>
                                        <option value="absent">Absent</option>
                                        <option value="sick off">Sick Off</option>
                                        <option value="week off">Week Off</option>
                                        <option value="holiday">Holiday</option>
                                        <option value="al">Annual Leave</option>
                                        <option value="ml">Maternity Leave</option>
                                        <option value="pl">Paternity Leave</option>
                                        <option value="cl">Compassionate  Leave</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Date <span class="text-danger ">*</span></label>
                                    <select id="record_date" class="form-control @error ('record_date') is-invalid @enderror" required name="record_date">
                                        @foreach ($dates as $d)
                                            <option  value="{{$d->format('Y-m-d')}}">{{$d->format('d').' - '.$d->format('D')}}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Comments <span class="text-danger">*</span></label>
                                    <textarea rows="4" class="form-control @error ('comments') is-invalid @enderror" name="comments" >{{old('comments', '')}}</textarea>
                                    @error('comments')
                                    <span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
                                    @enderror
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary continue-btn">Save</button>
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

            <!-- Mark attendance /Atendance Modal -->

            <!-- Attendance upload Modal -->
            <div id="upload_attendance" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Upload Attendance</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('import_attendance')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div>
                                    <div class="form-group row">
                                        <a href="{{route('attendance_download_template')}}" class="btn btn-primary "> <i class="fa fa-download"></i> Get template</a>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Select file to upload </label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="file" required name="file_to_import">
                                        </div>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Attendance upload Modal -->
        @endcan
    </div>
    <!-- Page Wrapper -->
@endsection
@section('custom_js')
    <script>

        $(document).ready(function () {

            $('#table').DataTable({
                retrieve: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'colvis'
                ]
            });

            $('.attendance-btn').on('click', function () {
                $('#record_date').val($(this).data('day'));
                $('#employee_id').val($(this).data('employee'));
//If you want to pass data to for action for a form, you can do this
                $('#decline-loan-form').attr('action', $(this).data('decline-link'));
            });
        })

    </script>
@endsection


