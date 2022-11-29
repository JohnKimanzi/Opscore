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
                            <h3 class="page-title">Edit Client</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Clients</li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_project"><i class="fa fa-plus"></i> Add Project</a>
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_client"><i class="fa fa-plus"></i> Add Client</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <!-- Leave Statistics -->
                
                <!-- /Leave Statistics -->
                
                <!-- Search Filter -->
                
                <!-- /Search Filter -->
                
                <div class="row">
                    <div class="card col-md-10 offset-1">
                        <form action="{{route('clients.update', $editable_client)}}" method="POST">
                            <div class="card-body">
                                @csrf
                                @method('PATCH')
                                @include('clients.client_form')
                                <div class="row">
                                    <div class="col-md-12 d-flex">
                                        <div class="card card-table flex-fill">
                                            <div class="card-header">
                                                <h3 class="card-title mb-0  text-info">Client Contact People</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table custom-table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Status</th>
                                                                <th>Email</th>
                                                                <th>Primary phone</th>
                                                                <th>Secondary phone</th>
                                                                <th class="text-right">Action</th>
                                                            </tr>
                                                        </thead>
                                                        @if (count($contact_people=$editable_client->contact_people)>0)
                                                            @foreach($contact_people as $cp)
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <h2 class="table-avatar">
                                                                                <a href="#" class="avatar"><img alt="" src="img/profiles/avatar-19.jpg"></a>
                                                                                <a href="client-profile">{{$cp->name}}<span>{{$cp->designation}}</span></a>
                                                                            </h2>
                                                                        </td>
                                                                        <td>{{$cp->description}}</td>
                                                                        <td>{{$cp->email}}</td>
                                                                        <td>{{$cp->phone1}}</td>
                                                                        <td>{{$cp->phone2}}</td>
                                                                        
                                                                        <td class="text-right">
                                                                            <div class="dropdown dropdown-action">
                                                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                                
                                                                                    <!-- be redirected to edit menu-->
                                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                                                    <!-- be routed to delete menu -->
                                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> delete</a>
                                                                                
                                                                                   <!-- <a class="dropdown-item" href="#"><i class="fa fa-pencil m-r-5"></i> edit</a>
                                                                                    <a class="dropdown-item" href="oute('delete_client',$cp->id) }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                                                -->
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            @endforeach 
                                                        @endif
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
            <!-- Add Project Modal -->
            <div id="add_project" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">New Project</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('projects.store')}}" method="POST">
                                @csrf
                                @include('projects.projects_form')
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Project Modal -->

            <!-- Create Client Modal -->
            <div id="create_client" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">New Client</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('clients.store')}}" method="POST">
                                @csrf
                                @include('clients.client_form')
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Create Client Modal -->
        </div>
        <!-- /Page Wrapper -->
@endsection