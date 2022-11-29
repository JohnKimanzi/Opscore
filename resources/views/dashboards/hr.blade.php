@extends('layouts.smart-hr', ['title' => 'HR'])
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
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<div class="card dash-widget bg-danger" >
					<div class="card-body">
						<span class="dash-widget-icon"><i class="fa fa-briefcase"></i></span>
						<div class="dash-widget-info">
							<h3>{{$employees->where('contract_expiry', '<=', Carbon::now()->endOfMonth())->where('contract_expiry', '>=', Carbon::now()->subMonths(1)->endOfMonth())->count()}}</h3>
							<span>Contracts Expiring</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<div class="card dash-widget bg-warning">
					<div class="card-body">
						<span class="dash-widget-icon"><i class="fa fa-address-card"></i></span>
						<div class="dash-widget-info">
							<h3>{{$employees->where('contract_expiry', '<=', Carbon::now())->count()}}</h3>
							<span>Renewals Overdue</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<div class="card dash-widget bg-info">
					<div class="card-body">
						<span class="dash-widget-icon"><i class="la la-users"></i></span>
						<div class="dash-widget-info">
							<h3>  {{App\Models\Employee::onlyTrashed()->count()}}</h3>
							<span>Total Attritions</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<div class="card dash-widget bg-success">
					<div class="card-body">
						<span class="dash-widget-icon"><i class="fa fa-users"></i></span>
						<div class="dash-widget-info">
							<h3>{{$employees->count()}}</h3>
							<span>Total Employees</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		{{-- charts --}}
		<div class="row">
			<div class="col-md-12">
				<div class="card-deck card-group m-b-30">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between mb-3">
								<div>
									<span class="d-block">New Employees This Month</span>
								</div>
								<div>
									@php
										$new_employees=$employees->where('contract_start', '>',  Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString());
										$old_employees=$employees->where('contract_start', '<=',  Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString());
									@endphp
									<span class="text-success">+{{$p=($new_employees->count()/$old_employees->count())*100}}%</span>
								</div>
							</div>
							<h3 class="mb-3">{{$new_employees->count()}}</h3>
							<div class="progress mb-2" style="height: 5px;">
								<div class="progress-bar bg-primary" role="progressbar" style="width: {{$p}}%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<p class="mb-0">Previously: <span class="text-muted">{{$old_employees->count()}}</span></p>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between mb-3">
								<div>
									<span class="d-block">Expected salary increase</span>
								</div>
								<div>
									<span class="text-success">+12.5%</span>
								</div>
							</div>
							<h3 class="mb-3">Ksh {{$new_employees->sum('salary')}}</h3>
							<div class="progress mb-2" style="height: 5px;">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<p class="mb-0">Previous Month <span class="text-muted">Ksh {{$old_employees->sum('salary')}}</span></p>
						</div>
					</div>

					{{-- <div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between mb-3">
								<div>
									<span class="d-block">Expenses</span>
								</div>
								<div>
									<span class="text-danger">-2.8%</span>
								</div>
							</div>
							<h3 class="mb-3">Ksh8,500</h3>
							<div class="progress mb-2" style="height: 5px;">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<p class="mb-0">Previous Month <span class="text-muted">Ksh7,500</span></p>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between mb-3">
								<div>
									<span class="d-block">Profit</span>
								</div>
								<div>
									<span class="text-danger">-75%</span>
								</div>
							</div>
							<h3 class="mb-3">$1,12,000</h3>
							<div class="progress mb-2" style="height: 5px;">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<p class="mb-0">Previous Month <span class="text-muted">$1,42,000</span></p>
						</div>
					</div> --}}
				</div>
			</div>
		</div>

		<!-- Statistics Widget -->
		<div class="row">
			<div class="col-md-6 d-flex">
				<div class="card flex-fill dash-statistics">
					<div class="card-body">
						<h5 class="card-title">Statistics</h5>
						<div class="stats-list">
							<div class="stats-info">
								<p>Leave applications this month <strong>{{$leaves->where('start_date', '>=', Carbon::now()->subMonths(1)->endOfMonth())->count()}}<small>/ {{$leaves->count()}}</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-primary" role="progressbar" style="width: {{(($leaves->where('start_date', '>=', Carbon::now()->subMonths(1)->endOfMonth())->count())/($leaves->count()))*100}}%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>Approved <strong>{{$leaves->where('start_date', '>=', Carbon::now()->subMonths(1)->endOfMonth())->where('status', 'Approved')->count()}}<small>/ {{$leaves->where('start_date', '>=', Carbon::now()->subMonths(1)->endOfMonth())->count()}}</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-success" role="progressbar" style="width: {{(($leaves->where('start_date', '>=', Carbon::now()->subMonths(1)->endOfMonth())->where('status', 'Approved')->count())/($leaves->where('start_date', '>=', Carbon::now()->subMonths(1)->endOfMonth())->count()))*100}}%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>Pending <strong>{{$leaves->where('start_date', '>=', Carbon::now()->subMonths(1)->endOfMonth())->where('status', 'Pending')->count()}}<small>/ {{$leaves->where('start_date', '>=', Carbon::now()->subMonths(1)->endOfMonth())->count()}}</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-warning" role="progressbar" style="width: {{(($leaves->where('start_date', '>=', Carbon::now()->subMonths(1)->endOfMonth())->where('status', 'Pending')->count())/($leaves->where('start_date', '>=', Carbon::now()->subMonths(1)->endOfMonth())->count()))*100}}%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>Rejected <strong>{{$leaves->where('start_date', '>=', Carbon::now()->subMonths(1)->endOfMonth())->where('status', 'Rejected')->count()}}<small>/ {{$leaves->where('start_date', '>=', Carbon::now()->subMonths(1)->endOfMonth())->count()}}</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-danger" role="progressbar" style="width: {{(($leaves->where('start_date', '>=', Carbon::now()->subMonths(1)->endOfMonth())->where('status', 'Rejected')->count())/($leaves->where('start_date', '>=', Carbon::now()->subMonths(1)->endOfMonth())->count()))*100}}%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>Still on leave <strong>{{$leaves->where('end_date', '>=', Carbon::now())->where('status', 'Approved')->count()}}<small>/ {{$leaves->count()}}</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-info" role="progressbar" style="width: {{(($leaves->where('end_date', '>=', Carbon::now())->where('status', 'Approved')->count())/($leaves->count()))*100}}%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			{{-- <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
				<div class="card flex-fill">
					<div class="card-body">
						<h4 class="card-title">Task Statistics</h4>
						<div class="statistics">
							<div class="row">
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Total Tasks</p>
										<h3>385</h3>
									</div>
								</div>
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Overdue Tasks</p>
										<h3>19</h3>
									</div>
								</div>
							</div>
						</div>
						<div class="progress mb-4">
							<div class="progress-bar bg-purple" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">30%</div>
							<div class="progress-bar bg-warning" role="progressbar" style="width: 22%" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">22%</div>
							<div class="progress-bar bg-success" role="progressbar" style="width: 24%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100">24%</div>
							<div class="progress-bar bg-danger" role="progressbar" style="width: 26%" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">21%</div>
							<div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">10%</div>
						</div>
						<div>
							<p><i class="fa fa-dot-circle-o text-purple mr-2"></i>Completed Tasks <span class="float-right">166</span></p>
							<p><i class="fa fa-dot-circle-o text-warning mr-2"></i>Inprogress Tasks <span class="float-right">115</span></p>
							<p><i class="fa fa-dot-circle-o text-success mr-2"></i>On Hold Tasks <span class="float-right">31</span></p>
							<p><i class="fa fa-dot-circle-o text-danger mr-2"></i>Pending Tasks <span class="float-right">47</span></p>
							<p class="mb-0"><i class="fa fa-dot-circle-o text-info mr-2"></i>Review Tasks <span class="float-right">5</span></p>
						</div>
					</div>
				</div>
			</div> --}}

			<div class="col-md-6 d-flex">
				 <!--Employees Per Contract-->
					<div class="card flex-fill dash-statistics">
						<div class="card-body">
							<h5 class="card-title">Employees Per Contract Type</h5>
							<div class="stats-list">
								@forelse ($contracts=\App\Models\Contract::all() as $contract)
									<a href="{{ route('contract_employees', $contract) }}">
										<div class="stats-info">
											<p><strong>{{ $contract->name }}</strong></p>
											<p class="float-right">{{ $contract->employees->count() }}</p>
											<div class="progress">
												<div class="progress-bar bg-primary" role="progressbar"
													style="width: {{ $contract->employees->count() }}%"
													aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</a>
								@empty
								@endforelse
							</div>
						</div>
					</div>
			</div>
		</div>
		<!-- /Statistics Widget -->

		<div class="row">
			<div class="col-md-6 d-flex">
				<div class="card card-table flex-fill">
					<div class="card-header">
						<h3 class="card-title mb-0">Teams</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-nowrap custom-table mb-0">
								<thead>
									<tr>
										<th>Name</th>
										<th>Team Lead</th>
										<th>Head count</th>
										{{-- <th>Status</th> --}}
									</tr>
								</thead>
								<tbody>
									@forelse ($teams as $team)
										<tr>
											<td><a href="{{route('teams.show', $team)}}">{{$team->name}}</a></td>
											{{-- <td>
												<h2><a href="#">{{($team->project)?$team->project->name:''}}</a></h2>
											</td> --}}
											<td>
												@if($team->leads)
													<h2><a href="#">{{implode(',',$team->leads->map->employee->pluck('first_name')->toArray())}}</a></h2>
												@endif
											</td>
											<td>{{$team->members->count()}}</td>
											{{-- <td>
												<span class="badge bg-inverse-success">active</span>
											</td> --}}
										</tr>
                                        @empty
									@endforelse
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer">
						<a href="{{route('teams.index')}}">View all teams</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 d-flex">
				<div class="card card-table flex-fill">
					<div class="card-header">
						<h3 class="card-title mb-0">Departments</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table custom-table table-nowrap mb-0">
								<thead>
									<tr>
										<th>Name</th>
										<th>Head Count</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($departments as $dpt)
										<tr>
											<td><a href="{{route('department_employees', $dpt)}}">{{$dpt->name}}</a></td>
											<td>{{($dpt->employees)?$dpt->employees->count():''}}</td>
										</tr>
                                        @empty
									@endforelse
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer">
						<a href="{{route('departments.index')}}">View all departments</a>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 d-flex">
				<div class="card card-table flex-fill">
					<div class="card-header">
						<h3 class="card-title mb-0">Clients</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table custom-table mb-0">
								<thead>
									<tr>
										<th>Company Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Status</th>
										{{-- <th class="text-right">Action</th> --}}
									</tr>
								</thead>
								<tbody>
									@forelse ($clients as $client)
									<tr>
										<td>
											<h2 class="table-avatar">
												<a href="{{route('clients.show', $client)}}">{{$client->name}} </a>
											</h2>
										</td>
										<td>{{$client->email ?? 'N/A'}}</td>
										<td>{{$client->phone1 ?? 'N/A'}}</td>
										<td>{{$client->status->name}}
											{{-- <div class="dropdown action-label"> --}}
												{{-- <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
													<i class="fa fa-dot-circle-o text-success"></i> {{$client->status->name}}
												</a> --}}
												{{-- <div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
													<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
												</div> --}}
											{{-- </div> --}}
										</td>
										{{-- <td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
												</div>
											</div>
										</td> --}}
									</tr>
                                    @empty
									@endforelse
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer">
						<a href="{{route('clients.index')}}">View all clients</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 d-flex">
				<div class="card card-table flex-fill">
					<div class="card-header">
						<h3 class="card-title mb-0"> Projects</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table custom-table mb-0">
								<thead>
									<tr>
										<th>Project Name </th>
										<th> Work Force Distribution</th>
										{{-- <th class="text-right">Action</th> --}}
									</tr>
								</thead>
								<tbody>
									@forelse($projects as $project)
									<tr>
										<td>
											<h2><a href="{{route('projects.show', $project)}}">{{$project->name}}</a></h2>
											{{-- <small class="block text-ellipsis">
												<span>1</span> <span class="text-muted">open tasks, </span>
												<span>9</span> <span class="text-muted">tasks completed</span>
											</small> --}}
										</td>
										<td>
											<p> <strong>{{$x=($project->employees)?$project->employees->count():0}} <small>/
												{{$t=$employees->count()}}</small></strong></p>
											<div class="progress progress-xs progress-striped">
												<div class="progress-bar" role="progressbar" data-toggle="tooltip" title="65%" style="width: {{($x/$t)*100}}%"></div>
											</div>
										</td>
										{{-- <td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
												</div>
											</div>
										</td> --}}
									</tr>
                                    @empty
									@endforelse
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer">
						<a href="{{route('projects.index')}}">View all projects</a>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- /Page Content -->
</div>
<!-- /Page Wrapper -->
@endsection
