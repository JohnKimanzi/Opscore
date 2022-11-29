@extends('layouts.smart-hr', ['title' => 'Announcements'])
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Edit Announcement</h3>
                    </div>
                </div>
            </div>
            <div class="container">
                <form method='POST' action="{{route('announcements.update', $announcement)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="code">Title</label>
                        <input type="text" name="title" value="{{ $announcement->title }}" class='form-control'
                            placeholder='title'>
                    </div>
                    <div class="form-group">
                        <label for="name">Content</label>
                        <input type="text" name="body" value="{{ $announcement->body }}" class='form-control'
                            placeholder='content'>
                    </div>
                    <div class="form-group">
                        <label for="name">Channel name</label>
                        <input type="text" name="channel_id" value="{{ $announcement->channel_id }}"
                            class='form-control' placeholder='channel name'>
                    </div>
                    <div class="form-group">
                        <label for="name">Posted By:</label>
                        <input type="text" name="posted_by" value="{{ $announcement->posted_by }}"
                            class='form-control' placeholder='posted by'>
                    </div>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
