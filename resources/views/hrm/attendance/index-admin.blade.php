@extends('layouts.smart-hr')
@section('content')
	<!-- Page Wrapper -->
	<div class="page-wrapper">
		@include('layouts.partials.flash')
		<div class="content container-fluid">

			<!-- Page Header -->
			<div class="page-header">
				<div class="row align-items-center">
					<div class="col">
						<h3 class="page-title">Attendance
							@isset($period)
								<small>Records Between {{$period->start->copy()->format('d M Y')}} and {{$period->end->copy()->format('d M Y')}}</small>
							@endisset
						</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
							<li class="breadcrumb-item active">Attendance</li>
						</ul>
					</div>
                    {{-- <div class="col-auto float-right ml-auto"> --}}
                         <a href="#" class="btn add-btn ml-2" data-toggle="modal" data-target="#upload_attendance"><i
                            class="fa fa-upload"></i> Upload From Excel</a>
                         {{-- <a href="#" class="btn add-btn">
                            <i class="fa fa-download"></i> Export records</a> 
                     </div>  --}}
					 {{-- <div class="col-auto float-right ml-auto">
						<a href="#" class="btn add-btn" data-toggle="modal" data-target="#upload_attendance"><i
								class="fa fa-upload"></i> Upload From Excel</a>
                                <a href="{{ route('export_attendance') }}" class="btn add-btn m-3">
                                    <i class="fa fa-download"></i> Export records</a>
					</div>  --}}
				</div>
			</div>
			<!-- /Page Header -->

			<!-- Search Filter -->
			<form action="{{route("attendance_filter")}}" method="POST">
				@csrf
				<div class="row filter-row">
					{{-- <div class="col-auto col-sm-1">
						<div class="form-group form-focus ">
							<input type="text" class="form-control floating @error('flt_sap') is-invalid @enderror" name="flt_sap" value="{{old('flt_sap')}}">
							<label class="focus-label">SAP</label>
						</div>
						@error('flt_sap')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div> --}}
					@if($errors->any())
					<div class="error" >
						<p>{{$errors->first()}}</p>
					</div>
				@endif
					<div class="col-auto col-sm-2">
						<div class="form-group form-focus select-focus">
							<select class="form-control floating @error('flt_team_id') is-invalid @enderror" name='flt_team_id'>
								<option value="" selected>  </option>
								@forelse($teams as $team)
									<option value='{{$team->id}}' @if(old('flt_team_id') == $team->id) selected @endif> {{$team->name}} ({{$team->members()->count()}} members) </option>
								@empty
									<option value=""> ---- </option>
								@endforelse
							</select>
							<label class="focus-label">Select Team</label>
						</div>
						@error('flt_team_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
						<div class="col-auto col-sm-2">
							<div class="form-group form-focus select-focus">
								<select class="form-control floating @error('flt_project_id') is-invalid @enderror" name='flt_project_id'>
									<option value="" selected>  </option>
									@forelse($projects=\App\Models\Project::all() as $project)
										<option value='{{$project->id}}' @if(old('flt_project_id') == $project->id) selected @endif> {{$project->name}} ({{$project->employees()->count()}} members) </option>
									@empty
										<option value=""> ---- </option>
									@endforelse
								</select>
								<label class="focus-label">Select Project</label>
							</div>
							@error('flt_project_id')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					<div class="col-auto col-sm-2">
						<div class="form-group form-focus select-focus">
							<div >
								<input class="form-control floating @error('flt_from') is-invalid @enderror" type="date" name="flt_from" value="{{old('flt_from')}}">
							</div>
							<label class="focus-label">From</label>
							@error('flt_from')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

					</div>

					<div class="col-auto col-sm-2">
						<div class="form-group form-focus select-focus">
							<div >
								<input class="form-control floating @error('flt_to') is-invalid @enderror" type="date" name="flt_to" value="{{old('flt_to')}}">
							</div>
							<label class="focus-label">To</label>
						</div>
						@error('flt_to')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="col-auto col-sm-2">
						<button class="btn btn-warning btn-block"> Search </button>
					</div>
					<div class="col-auto col-sm-2">
						<a href="{{route('attendance.index')}}" class="btn btn-danger btn-block"> Reset </a>
					</div>
				</div>
			</form>
			<!-- /Search Filter -->

			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table id="table" class="table table-striped custom-table table-nowrap mb-0">
							<thead>
								<tr>
                                    <th>Employee</th>
                                    @foreach($period as $day)
										<th class="text-center">{{$day->copy()->format('d')}} <br> {{$day->format('D')}}</th>
									@endforeach
								</tr>
							</thead>
							<tbody>
								@foreach ($employees as $employee)
									<tr>
										<td style="position:sticky">
											<h2 class="table-avatar">
												{{-- <a class="avatar avatar-xs" href="profile.html"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a> --}}
												<a href="{{route('employees.show', $employee)}}">{{$employee->name}}</a>
											</h2>
										</td>
										@foreach($period as $day)
										@php($day=Carbon\CarbonImmutable::make($day))
										@php($attendances=$employee->attendances()->wheredate('record_date', $day->format('Y-m-d')))
											<td style="text-align: center">
												<a class='attendance-btn' href='' data-toggle='modal' data-target='#mark-attendance'  data-employee='{{$employee->id}}' data-day='{{$day->format('Y-m-d')}}'>
													@php($a=$attendances->first())

													@if ($attendances->count()==0)
														<i class="fa fa-minus text-dark "></i>

													@elseif (strtolower($a->status)=='present')
														<div class=" text-white bg-success">P</div>

													@elseif (strtolower($a->status)=='absent')
														<div class=" text-white bg-danger">A</div>
													@elseif (strtolower($a->status)=='sick off' || $a->status=='Sick Off')
														<div class=" text-white bg-danger">SO</div>

													@elseif (strtolower($a->status)=='week off')
														<div class=" text-white bg-info">O</div>
                                                    @elseif (strtolower($a->status)=='comp off')
														<div class=" text-white bg-info">CO</div>
													@elseif (strtolower($a->status)=='al'||$a->status =='Annual Leave')
														<div class=" text-white bg-info">AL</div>
													@elseif (strtolower($a->status)=='maternity leave' || strtolower($a->status)=='ml' || $a->status=='Maternity Leave')
														<div class="text-white" style="background-color: brown">ML</div>
													@elseif (strtolower($a->status)=='paternity leave' || strtolower($a->status)=='pl' || $a->status=='Paternity Leave')
														<div class=" text-white" style="background-color: rebeccapurple">PL</div>
													@elseif (strtolower($a->status)=='cl' || $a->status=='Compassionate Leave')
														<div class="text-white" style="background-color: hotpink">CL</div>
													@elseif (strtolower($a->status)=='holiday')
														<div class=" text-white bg-info">H</div>

													@elseif (strtolower($a->status)=='halfday' || strtolower($a->status)=='half day')
														<div class=" text-white bg-warning">HD</div>
														</a>

													@else
                                                    <i class="fa fa-exclamation text-warning"></i>
													@endif
												</a>
											</td>
										@endforeach
									</tr>
								@endforeach

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- /Page Content -->

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
									<select id="employee_id" class="form-control @error ('employee_id') is-invalid @enderror" required name="employee_id">
										@foreach ($employees as $employee)
											<option  value="{{$employee->id}}">{{$employee->name}}</option>
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
                                        <option value="comp off">Comp Off</option>
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
										@foreach ($period as $d)
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
									<label class="text-info">Comments</label>
									<textarea rows="4" class="mb-2 form-control @error ('comments') is-invalid @enderror" name="comments" >{{old('comments', '')}}</textarea>
									@error('comments')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#table').DataTable({
                retrieve: true,
                pageLength:50,
                searching: true,
                dom: 'lBfrtip',
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

        });
        })
    </script>
@endsection
{{-- @section('custom_js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {

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

        });
    })

</script>
@endsection --}}


