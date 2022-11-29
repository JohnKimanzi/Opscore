@extends('layouts.smart-hr', ['title' => 'Create Announcement'])
@section('content')
    <div class="page-wrapper" id="app">
        <!-- Page Content -->
        @include('layouts.partials.flash')
        <div class="content container-fluid">

            <!--Page Header-->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Announcements</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">/ Create announcements</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Announcement Info</h4>
                        </div>
                        <div class="card-body">
                            <!--Your Form-->
                            <create-announce :channels="{{ $channels }}" :announcements="{{ $announcements}}">
                            </create-announce>
                            <!--/Your Form-->
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
    
    