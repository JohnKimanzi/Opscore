@extends('layouts.smart-hr', ['title'=>'Dashboard'])
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
			<div class="col-md-6 col-sm-12 col-lg-6 col-xl-6">
				<div class="card dash-widget bg-info" >
					<div class="card-body">
						<span class="dash-widget-icon"><i class="fa fa-briefcase"></i></span>
						<div class="dash-widget-info">
							<h3>{{Auth::user()->employee->project->name}}</h3>
							<span>My project</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-12 col-lg-6 col-xl-6">
				<div class="card dash-widget bg-warning">
					<div class="card-body">
						<span class="dash-widget-icon"><i class="fa fa-address-card"></i></span>
						<div class="dash-widget-info">
							<h3>{{Auth::user()->employee->team->name}}</h3>
							<span>My Team</span>
						</div>
					</div>
				</div>
			</div>
            @role('Team Coordinator')
			<div class="col-md-6 col-sm-12 col-lg-6 col-xl-6">
				<div class="card dash-widget bg-info">
					<div class="card-body">
						<span class="dash-widget-icon"><i class="la la-sitemap"></i></span>
						<div class="dash-widget-info">
							<h3>{{Auth::user()->employee->team->members->count()}}</h3>
							<span>Team Members</span>
						</div>
					</div>
				</div>
			</div>
            @endrole
		</div>
		{{-- charts --}}


		<!-- Statistics Widget -->
		<div class="row">
			<div class="col-lg-6 d-flex">
				<div class="card flex-fill border-success dash-statistics">
					<div class="card-header bg-success">
						<h4 class="card-title">Leave Balances</h4>
					</div>
					<div class="card-body">
						<div class="stats-list">
							<div class="stats-info">
								{{-- <p>Annual Leave <strong>@if(count($leaves)>0){{$leaves->where('created_at', '>', Carbon::now()->subMonths(1)->endOfMonth())->count()}} @else 0 @endif <small>/ 21 days</small></strong></p> --}}
								<p>Annual Leave <strong>{{Auth::user()->employee->leave_balances()->where('record_year', Carbon::now()->format('Y'))->whereHas('leave_category', fn($q) => $q->where('name', 'like', '%annual%'))->pluck('consumed')->first() ?? "0"}} <small>/ 21 days</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-primary" role="progressbar" style="width: {{((Auth::user()->employee->leave_balances()->where('record_year', Carbon::now()->format('Y'))->whereHas('leave_category', fn($q) => $q->where('name', 'like', '%annual%'))->pluck('consumed')->first() ?? 0)/21)*100}}%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>Sick offs <strong>{{Auth::user()->employee->leave_balances()->where('record_year', Carbon::now()->format('Y'))->whereHas('leave_category', fn($q) => $q->where('name', 'like', '%sick%'))->pluck('consumed')->first() ?? "0"}}<small>/ 10 days</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-success" role="progressbar" style="width: {{((Auth::user()->employee->leave_balances()->where('record_year', Carbon::now()->format('Y'))->whereHas('leave_category', fn($q) => $q->where('name', 'like', '%sick%'))->pluck('consumed')->first() ?? 0)/10)*100}}%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>Compassionate <strong>{{Auth::user()->employee->leave_balances()->where('record_year', Carbon::now()->format('Y'))->whereHas('leave_category', fn($q) => $q->where('name', 'like', '%compassionate%'))->pluck('consumed')->first() ?? "0"}} <small>/ 5 days</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-warning" role="progressbar" style="width: {{((Auth::user()->employee->leave_balances()->where('record_year', Carbon::now()->format('Y'))->whereHas('leave_category', fn($q) => $q->where('name', 'like', '%paternity%'))->pluck('consumed')->first() ?? 0)/5)*100}}%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
                            @if (Str::contains(Str::lower(Auth::user()->employee->gender->name), 'female'))
							<div class="stats-info">
								<p>Maternity Leave <strong>{{Auth::user()->employee->leave_balances()->where('record_year', Carbon::now()->format('Y'))->whereHas('leave_category', fn($q) => $q->where('name', 'like', '%maternity%'))->pluck('consumed')->first() ?? "0"}} <small>/ 90 days</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-info" role="progressbar" style="width: {{((Auth::user()->employee->leave_balances()->where('record_year', Carbon::now()->format('Y'))->whereHas('leave_category', fn($q) => $q->where('name', 'like', '%maternity%'))->pluck('consumed')->first() ?? 0)/90)*100}}%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
                            @else
                            <div class="stats-info">
								<p>Paternity Leave <strong>{{Auth::user()->employee->leave_balances()->where('record_year', Carbon::now()->format('Y'))->whereHas('leave_category', fn($q) => $q->where('name', 'like', '%paternity%'))->pluck('consumed')->first() ?? "0"}} <small>/ 14 days</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-danger" role="progressbar" style="width: {{((Auth::user()->employee->leave_balances()->where('record_year', Carbon::now()->format('Y'))->whereHas('leave_category', fn($q) => $q->where('name', 'like', '%paternity%'))->pluck('consumed')->first() ?? 0)/14)*100}}%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
                            @endif

						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 d-flex">
				<div class="card card-table flex-fill">
					<div class="card-header">
						<h3 class="card-title mb-0">Fellow Team members</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-nowrap custom-table mb-0">
								<thead>
									<tr>
										<th>Name</th>
										<th>phone</th>
										<th>Email</th>
										<th>Queue</th>
										<th>Day off</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($members as $member)
										<tr>
											<td><h2><a href="#">{{$member->name}}</a></h2></td>
											<td>{{$member->phone1}}</td>
											<td><a href="mailto: {{$member->work_email}}">{{$member->work_email}}</a></td>
											<td>{{1}}</td>
											<td><span class="badge">Sun</span></td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer">
						<a href="#">Team <u>{{Auth::user()->employee->team->name}}</u></a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
		<div class="col-md-12 d-flex">
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
		<!-- /Statistics Widget -->
	</div>
	<!-- /Page Content -->
</div>
<!-- /Page Wrapper -->
@endsection
