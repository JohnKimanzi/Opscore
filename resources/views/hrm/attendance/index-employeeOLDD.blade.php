@extends('layouts.smart-hr')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Attendance</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Attendance</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

			<div class="row">
				<div class="col-md-4">
					<div class="card punch-status">
						<div class="card-body">
							<h5 class="card-title">Timesheet <small class="text-muted flex float-right">{{\Carbon\Carbon::today()->toFormattedDateString()}}</small></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
