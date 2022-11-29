@extends('layouts.smart-hr', ['title' => 'Channels'])
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Edit Channel</h3>
                    </div>
                </div>
            </div>
            <div class="container">
                <form method='POST' action="{{route('channels.update', $channel)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="code">Name</label>
                        <input type="text" name="name" value="{{ $channel->name }}" class='form-control'
                            placeholder='name'>
                    </div>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
