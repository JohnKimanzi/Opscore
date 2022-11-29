@extends('layouts.smart-hr', ['title' => 'Permissions'])
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Edit Permission</h3>
                    </div>
                </div>
            </div>
            <div class="container">
                <form method='POST' action="{{ route('permissions.update', $permission->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="code">Permission Name</label>
                        <input type="text" name="name" value="{{ $permission->name }}" class='form-control'
                            placeholder='Permission Name'>
                    </div>
                    <div class="form-group">
                        <label for="name">Guard Name</label>
                        <input type="text" name="guard_name" value="{{ $permission->guard_name }}" class='form-control'
                            placeholder='Guard Name'>
                    </div>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
