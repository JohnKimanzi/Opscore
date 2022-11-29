@extends('layouts.smart-hr', ['title' => 'Channels'])
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="col">
                    <div class="col-auto float-right ml-auto">
                        @can('Manage Employees')
                            <a href="{{ route('subscriptions.create') }}" class="btn add-btn btn-sm"><i class="fa fa-plus"></i> Add
                                subscription</a>
                        @endcan
                    </div>
                <h2> <u>{{ $channel->name }}</u></h2>
                <small>Created {{ $channel->created_at->diffForHumans() }}</small>
            </div>
            </div>
            <!-- /Page Header-->
            <div class="col-sm-12 d-flex justify-content-start">
                <div class="card" style="width: 60%;">
                    <div class="card-header">
                        <h4 class="card-title"> <u>Channel Details </u></h4>
                        <p> Name: {{ $channel->name }}</p>
                        <p> Description: {{ $channel->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
             <!-- /Page Content-->
        </div>
        <!-- /Page Wrapper-->
@endsection
