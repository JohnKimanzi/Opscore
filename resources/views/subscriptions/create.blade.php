@extends('layouts.smart-hr', ['title' => 'Create Subscription'])
@section('content')
    <div class="page-wrapper" id="app">
        <!-- Page Content -->
        @include('layouts.partials.flash')
        <div class="content container-fluid">

            <!--Page Header-->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Subscriptions</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">/ Add subscription</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Subscription</h4>
                        </div>
                        <div class="card-body">
                            <!--Your Form-->
                            <create-subscribe :channels="{{ $channels }}" :subscriptions="{{ $subscriptions}}">
                            </create-subscribe>
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

