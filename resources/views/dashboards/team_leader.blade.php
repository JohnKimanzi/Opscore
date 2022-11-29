@extends('layouts.smart-hr', ['title'=>'Team Leader Dashboard'])
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title">Welcome {{Auth::user()->name}}!</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item active">Dashboard</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

		<div class="row">
			<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
				<div class="card dash-widget bg-danger" >
					<div class="card-body">
						<span class="dash-widget-icon"><i class="fa fa-briefcase"></i></span>
						<div class="dash-widget-info">
							<h3>{{Auth::user()->employee->project->name}}</h3>
							<span>My project</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
				<div class="card dash-widget bg-warning">
					<div class="card-body">
						<span class="dash-widget-icon"><i class="fa fa-address-card"></i></span>
						<div class="dash-widget-info">
							<h3>{{Auth::user()->employee->team->name ?? '--'}}</h3>
							<span>My team</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
				<div class="card dash-widget bg-info">
					<div class="card-body">
						<span class="dash-widget-icon"><i class="la la-sitemap"></i></span>
						<div class="dash-widget-info">
							<h3>Teams I Lead</h3>
							@foreach(Auth::user()->employee->teams_i_can_manage as $team)
							<ul class="list-unstyled">
								<li>{{$team->name}} - {{$team->members->count()}} Members</li>
							</ul>
							@endforeach
						</div>
					</div>
				</div>
			</div>

		</div>
		{{-- charts --}}


		<!-- Statistics Widget -->
		<div class="row">
			<div class="col-md-12 col-lg-6 col-xl-4 d-flex">

				<div class="card flex-fill border-success dash-statistics">
					<div class="card-header bg-success">
						<h4 class="card-title">Leave Statistics This Month</h4>
					</div>
					<div class="card-body">
						<div class="stats-list">
							<div class="stats-info">
								<p>Applications <strong>@if(count($members->flatMap->leaves)>0){{$members->flatMap->leaves->where('created_at', '>', Carbon::now()->subMonths(1)->endOfMonth())->count()}} @else 0 @endif <small>/ {{$members->count()}} members</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-primary" role="progressbar" style="width: {{null != ($members->flatMap->leaves->where('created_at', '>', Carbon::now()->subMonths(1)->endOfMonth())->count()) ? $members->flatMap->leaves->where('created_at', '>', Carbon::now()->subMonths(1)->endOfMonth())->count()/($members->count())*100 : '0'}}%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>Approved <strong>@if(count($members->flatMap->leaves)>0){{$members->flatMap->leaves->where('status', '=', 'Approved')->count()}} @else 0 @endif <small>/ {{$members->flatMap->leaves->count()}} leaves</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-primary" role="progressbar" style="width: {{ null != ($members->flatMap->leaves->where('status', '=', 'Approved')->count()) ? $members->flatMap->leaves->where('status', '=', 'Approved')->count() / ($members->flatMap->leaves->count())*100 : '0'}}%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>Pending <strong>@if(count($members->flatMap->leaves)>0){{$members->flatMap->leaves->where('status', '=', 'Pending')->count()}} @else 0 @endif <small>/ {{$members->flatMap->leaves->count()}} leaves</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-warning" role="progressbar" style="width: {{ null != ($members->flatMap->leaves->where('status', '=', 'Pending')->count()) ? $members->flatMap->leaves->where('status', '=', 'Pending')->count() / ($members->flatMap->leaves->count())*100 : '0'}}%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>Rejected <strong>@if(count($members->flatMap->leaves)>0){{$members->flatMap->leaves->where('status', '=', 'Declined')->count()}} @else 0 @endif <small>/ {{$members->flatMap->leaves->count()}} leaves</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-danger" role="progressbar" style="width: {{ null != ($members->flatMap->leaves->where('status', '=', 'Declined')->count()) ? $members->flatMap->leaves->where('status', '=', 'Declined')->count() /($members->flatMap->leaves->count())*100 : '0'}}%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>Currently on leave <strong>@if(count($members->flatMap->leaves)>0){{$members->flatMap->leaves->where('status', '=', 'Approved')->where('end_date', '>=', now())->count()}} @else 0 @endif <small>/ {{$members->count()}} members</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-info" role="progressbar" style="width: {{ null != ($members->flatMap->leaves->where('status', '=', 'Approved')->where('end_date', '>=', now())->count()) ? $members->flatMap->leaves->where('status', '=', 'Approved')->where('end_date', '>=', now())->count() /($members->count())*100 : '0'}}%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-12 col-lg-6 col-xl-4 d-flex">
				<div class="card flex-fill border-success">
					<div class="card-header bg-success">
						<h4 class="card-title">Attendance Statistics This Month</h4>
					</div>
					<div class="card-body">
						<div>
							<p><i class="fa fa-dot-circle-o text-success mr-2"></i>Present 100% <span class="float-right">{{count($members->flatMap->attendances->where('status', 'like','present')->where('record_date', '>', Carbon\Carbon::now()->subMonths(1)->endOfMonth()))}}</span></p>
							<p><i class="fa fa-dot-circle-o text-purple mr-2"></i>Half day <span class="float-right">{{count($members->flatMap->attendances->where('status', 'like','halfday')->where('record_date', '>', Carbon\Carbon::now()->subMonths(1)->endOfMonth()))}}</span></p>
							<p><i class="fa fa-dot-circle-o text-warning mr-2"></i>Sick offs <span class="float-right">{{count($members->flatMap->attendances->where('status', 'sick off')->where('record_date', '>', Carbon\Carbon::now()->subMonths(1)->endOfMonth()))}}</span></p>
							<p><i class="fa fa-dot-circle-o text-danger mr-2"></i>Absenteeism cases <span class="float-right">{{count($members->flatMap->attendances->where('status', 'absent')->where('record_date', '>', Carbon\Carbon::now()->subMonths(1)->endOfMonth()))}}</span></p>
							<a href="#"><p class="mb-4"><i class="fa fa-dot-circle-o text-info mr-2"></i>Leaves <span class="float-right">{{count($members->flatMap->leaves->where('end_date', '>', Carbon\Carbon::now()->subMonths(1)->endOfMonth()))}}</span></p></a>
                            <div class="load-more text-center border border-info">
                                <a class="text-dark" href="{{route('monthly_attendance_graph')}}">See This Month Graph</a>
                            </div>
                        </div>
					</div>
				</div>
			</div>

			<div class="col-md-12 col-lg-6 col-xl-4 d-flex">
				<div class="card flex-fill border-success">
					<div class="card-header bg-success">
						<h4 class="card-title">Attendance Overview Today</h4>
					</div>
					<div class="card-body">
						<h5 class=""> Present<span class="badge bg-inverse-danger ml-2 flex float-right">{{count($members->flatMap->attendances->where('status', 'like', 'present')->where('record_date', '=>', Carbon\Carbon::now()->format('Y-m-d')))}}</span></h5	>
						<h5 class=""> Week off<span class="badge bg-inverse-danger ml-2 flex float-right">{{count($members->flatMap->attendances->where('status', 'like', 'week off')->where('record_date', '=>', Carbon\Carbon::now()->format('Y-m-d')))}}</span></h5	>
						<h5 class=""> On Leave<span class="badge bg-inverse-danger ml-2 flex float-right">{{count($members->flatMap->leaves->where('end_date', '=', Carbon\Carbon::now()->format('Y-m-d')))}}</span></h5	>
						<h5 class=""> Sick Off<span class="badge bg-inverse-danger ml-2 flex float-right">{{count($members->flatMap->attendances->where('status', 'like','sick off')->where('record_date', '=>', Carbon\Carbon::now()->format('Y-m-d')))}}</span></h5	>
						<h5 class="text-warning"> Absent<span class="badge bg-inverse-danger ml-2 flex float-right">{{count($members->flatMap->attendances->where('status', 'like','absent')->where('record_date', '=>', Carbon\Carbon::now()->format('Y-m-d')))}}</span></h5>
						<div class="leave-info-box">
							<div class="media align-items-center">
								<div class="media-body">
									<span class="badge bg-inverse-danger">Absent Members</span>
								</div>
							</div>
							<div class="row align-items-center mt-3">
								@foreach($members->flatMap->attendances->where('status' , 'like', 'absent')->map->employee->pluck('name') as $em)
								<div class="col-12">
									{{$em}}
								</div>
								@endforeach
							</div>
						</div>

						<div class="load-more text-center">
							<a class="text-dark" href="{{route('attendance.index')}}">Attendance</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Statistics Widget -->

		<div class="row">
			<div class="col-md-6 d-flex">
				<div class="card card-table flex-fill">
					<div class="card-body">
						@foreach(Auth::user()->employee->teams_i_can_manage as $team)
						<div class="table-responsive">
							<div class="card-header">
								<h3 class="card-title mb-0">{{$team->name}} Members</h3>
							</div>
							<table class="table table-nowrap custom-table mb-0">
								<thead>
									<tr>
										<th>Name</th>
										<th>phone</th>
										<th>Email</th>
										<th>Week off</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($team->members as $member)
										<tr>
											<td><h2><a href="{{route('employees.show',$member)}}">{{$member->name}}</a></h2></td>
											<td>
												{{$member->phone1}}
											</td>
											<td>
												<a href="mailto: {{$member->work_email}}">{{$member->work_email}}</a>
											</td>
											<td>
												<span class="badge">Sun</span>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-md-6 d-flex">
				<div class="card card-table flex-fill">
					<div class="card-header">
						<h3 class="card-title mb-0">My Leave applications</h3>
					</div>
					<div class="card-body">
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

                                        {{-- <th class="text-right">Actions</th> --}}
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
                                        @empty
                                            No records.
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
					</div>
					<div class="card-footer">
						<a href="#">Leave applications</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Content -->
</div>
<!-- /Page Wrapper -->
@endsection
