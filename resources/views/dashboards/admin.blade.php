@extends('layouts.smart-hr', ['title' => 'Admin Dashboard'])
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->

        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome {{ \Illuminate\Support\Facades\Auth::user()->name }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            @if (isset($malePercentage))
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-group"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ count($employees) }}</h3>
                                    <span>Total Employees</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ count($projects) }}</h3>
                                    <span>Projects</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-briefcase"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ count($clients) }}</h3>
                                    <span>Clients</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{ count($departments) }}</h3>
                                    <span>Departments</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                @if (isset($malePercentage))
                    <!--Employee Gender Statistics-->
                    <div class="col-md-4 d-flex justify-content-center">
                        <div class="card flex-fill dash-statistics">
                            <div class="card-body">
                        {{-- <div class="col-md-6 text-center">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Males</h3>
                                        <h3 id="bar-charts">{{ round($malePercentage, 1) }} %</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Female</h3>
                                        <h3 id="bar-charts">{{ round($femalePercentage, 1) }} %</h3>
                                    </div>
                                </div>
                            </div> --}}
                            <h5 class="card-title">Employees Gender Statistics</h5>
                        {!! $chart->container() !!}
                            </div>
                        </div>
                    </div>

                    <!--Employees Per Contract-->
                    <div class="col-md-4 d-flex">
                        <div class="card flex-fill dash-statistics">
                            <div class="card-body">
                                <h5 class="card-title">Employees Per Contract Type</h5>
                                <div class="stats-list">
                                    @forelse ($contracts as $contract)
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
                    <!-- Statistics Widget -->
                    <div class="col-md-4 d-flex">
                        <div class="card flex-fill">
                            <div class="card-body">
                                <h4 class="card-title">Employees Per Country</h4>
                                {!! $chart2->container() !!}
                                {{-- <div>
                                    <p><i class="fa fa-dot-circle-o text-purple mr-2"></i>Kenya <span
                                            class="float-right">{{ $kEmployees }}</span></p>
                                    <p><i class="fa fa-dot-circle-o text-warning mr-2"></i>Uganda <span
                                            class="float-right">{{ $uEmployees }}</span></p>
                                    <p><i class="fa fa-dot-circle-o text-success mr-2"></i>Tanzania <span
                                            class="float-right">{{ $tEmployees }}</span></p>
                                    <p><i class="fa fa-dot-circle-o text-danger mr-2"></i>Zambia<span
                                            class="float-right">{{ $zEmployees }}</span></p>
                                    <p><i class="fa fa-dot-circle-o text-warning mr-2"></i>Malawi <span
                                            class="float-right">{{ $mEmployees }}</span></p>
                                    <p><i class="fa fa-dot-circle-o text-purple mr-2"></i>Ghana <span
                                            class="float-right">{{ $gEmployees }}</span></p>
                                    <p><i class="fa fa-dot-circle-o text-warning mr-2"></i>Ethiopia <span
                                            class="float-right">{{ $eEmployees }}</span></p>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-12 col-lg-12 col-xl-6 d-flex">
							<div class="card flex-fill dash-statistics">
								<div class="card-body">
									<h5 class="card-title">Employees Per Contract Type</h5>
									<div class="stats-list">
										<a href="{{route('employees_contract', $contract)}}">
											<div class="stats-info">
												<p>Contractual <strong> {{$cCount}}</small></strong></p>
												<div class="progress">
													<div class="progress-bar bg-warning" role="progressbar" style="width: {{($cCount/$employees->count())*100}}%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</a>
										<div class="stats-info">
											<p>Permanent <strong> {{$pCount}}</small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-primary" role="progressbar" style="width: {{($pCount/$employees->count())*100}}%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>

										<div class="stats-info">
											<p>Casual <strong> {{$csCount}}</small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-success" role="progressbar" style="width: {{($csCount/$employees->count())*100}}%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="stats-info">
											<p>On Job Training<strong>{{$oCount}}</small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-danger" role="progressbar" style="width: {{($oCount/$employees->count())*100}}%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div> --}}
                  
                    <!-- /Statistics Widget -->
                @endif
            </div>
            <!-- /Page Content -->
            <script src="{{ $chart->cdn() }}"></script>

            {{ $chart->script() }}
            <script src="{{ $chart2->cdn() }}"></script>

            {{ $chart2->script() }}
        </div>
        <!-- /Page Wrapper -->
    @endsection
