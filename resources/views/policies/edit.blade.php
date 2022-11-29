@extends('layouts.smart-hr')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
			@include('layouts.partials.flash')
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Edit Policy</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Policies</li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_policy"><i class="fa fa-plus"></i> Add Policy</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <div class="row">
                    <div class="card col-md-10 offset-1">
                        <form action="{{route('policies.update', $editable_policy)}}" method="POST">
                            <div class="card-body">
                                @csrf
                                @method('PATCH')
                                @include('policies.policy_form')
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->

            <!-- Create Policy Modal -->
            <div id="add_policy" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">New Policy</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('policies.store')}}" method="POST">
                                @csrf
                                @include('policies.policy_form')
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Create Policy Modal -->
        </div>
        <!-- /Page Wrapper -->
@endsection