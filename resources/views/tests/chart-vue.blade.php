@extends('layouts.smart-hr', ['title' => 'Create Channel'])
@section('content')
    @push('styles')
        <style>
            .chart-wrapper {
                display: flex;
                align-items: center;
                justify-content: center
            }
        </style>
    @endpush
    <div class="page-wrapper" id="app">
        <!-- Page Content -->
        @include('layouts.partials.flash')
        <div class="content container-fluid">

            <!--Page Header-->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Leaves on Attendance</h3>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <div class="chart-wrapper">
                            <!--Apex Charts Component-->
                            <leaves-attendance> </leaves-attendance>
                            <!--/Apex Charts Component-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content-->
    </div>
@endsection
@section('custom_js')
    <script src="{{ mix('/js/app.js') }}"></script>
@endsection
