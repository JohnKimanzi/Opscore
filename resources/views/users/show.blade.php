@extends('layouts.smart-hr', ['title' => 'Users'])
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <h2> <u>{{ $user->name }}</u> Profile Info</h2>
                <small>Registered {{ $user->created_at->diffForHumans() }}</small>
            </div>
            <div class="col-sm-12 d-flex justify-content-center">
            <div class="card" style="width: 60%;">
                <div class="card-header">
                    <h4 class="card-title"> <u>Other Details </u></h4>
                    <p> Email: {{ $user->email }}</p>
                    <p>Employee ID: @if ($user->employee_id != null)
                            {{ $user->employee_id }}
                        @else
                            --
                        @endif
                    </p>
                    <div>
                        @foreach ($user->roles as $role)
                            <p>Roles: {{ $role->name }} </p>
                        @endforeach
                            <p>Permissions: @if($user->roles){{$user->roles->map(function($role){return $role->permissions;})->collapse()->pluck('name')->unique()}}@else--@endif</p> 
                            <p>Projects involved: {{ isset($user->employee->project) ? $user->employee->project->name : '--'}} </p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
