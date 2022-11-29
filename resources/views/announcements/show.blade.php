@extends('layouts.smart-hr', ['title' => 'Announcements'])
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <h2> <u>{{ $announcement->title }}</u></h2>
                <small>Posted {{ $announcement->created_at->diffForHumans() }}</small>
            </div>
            <!-- /Page Header -->
            <div class="col-sm-12 d-flex justify-content-start">
                <div class="card" style="width: 60%;">
                    <div class="card-header">
                        <h4 class="card-title"> <u>Announcement Details </u></h4>
                        <p> Message: {{ $announcement->body }}</p>
                        <p>Posted by: {{$announcement->posted_by }}</p>
                        <p> Channel: {{ $announcement->channel->name }}</p>
                        {{-- <p> Status: {{ $announcement->status }}</p> --}}
                        </div>
                    </div>
                </div>
            </div>
             <!-- /Page Content -->
        </div>
          <!-- /Page Wrapper -->
@endsection
