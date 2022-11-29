@extends('layouts.smart-hr')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        @include('layouts.partials.flash')
        <!-- Page Content -->
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ $role->name }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Roles</a></li>
                            <li class="breadcrumb-item active">{{ $role->name }}</li>
                        </ul>
                        <div class="btn-toolbar float-right mt-0">
                            <a href="#" class="btn add-btn mr-2" data-toggle="modal"
                                data-target="#allocate_users_to_role"><i class="fa fa-plus"></i> Add Users to this
                                role</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="col-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Users with <b>{{ $role->name }}</b> Role</h3>
                    </div>
                    <div class="card-body">
                        @include('roles.users_table')
                    </div>
                </div>
            </div>
            <div class="col-auto mt-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Permissions for <b>{{ $role->name }}</b> Role</h3>
                    </div>
                    <div class="card-body">
                        @include('roles.permissions_table')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Allocate Users Modal to Role-->
    <div id="allocate_users_to_role" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Select users to allocate to the {{ $role->name }} role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user_role.allocate_users', $role) }}" method="POST">
                        @csrf
                        <div class="form-group role-duallist">
                            <label class="text-success" for="">Tip: use 'ctrl'+click or click and drag to select
                                multiple</label>
                            <div class="row">
                                <div class="col-lg-5 col-sm-5">
                                    <select name="edit_customleave_from" id="edit_customleave_select"
                                        class="form-control form-select" size="5" multiple="multiple">
                                        @forelse ($add_emp_to_role as $role_user)
                                            <option value="{{ $role_user->id }}">{{ $role_user->name }}</option>
                                        @empty
                                            <option value="">No options! Contact Admin</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="multiselect-controls col-lg-2 col-sm-2 d-grid gap-2">
                                    <button type="button" id="edit_customleave_select_rightAll"
                                        class="btn w-100 btn-white"><i class="fa fa-forward"></i></button>
                                    <button type="button" id="edit_customleave_select_rightSelected"
                                        class="btn w-100 btn-white"><i class="fa fa-chevron-right"></i></button>
                                    <button type="button" id="edit_customleave_select_leftSelected"
                                        class="btn w-100 btn-white"><i class="fa fa-chevron-left"></i></button>
                                    <button type="button" id="edit_customleave_select_leftAll"
                                        class="btn w-100 btn-white"><i class="fa fa-backward"></i></button>
                                </div>
                                <div class="col-lg-5 col-sm-5">
                                    <select name="user_ids[]" id="edit_customleave_select_to"
                                        class="form-control form-select" size="8" multiple="multiple">
                                        @forelse ($role->users as $role_user)
                                            <option value="{{ $role_user->id }}">{{ $role_user->name }}</option>
                                        @empty
                                            <option value="">No options! Contact Admin</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Allocate Selected</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="col-md-6">
                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-warning cancel-btn">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Allocate Users Modal to Role-->
@endsection
