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
                        <h3 class="page-title">{{$project->name}}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                            <li class="breadcrumb-item active">Project</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{route('projects.edit', $project)}}" class="btn add-btn"><i class="fa fa-plus"></i> Edit Project</a>
                        <a href="javascript:void()" class="btn btn-white float-right m-r-10" data-toggle="tooltip"
                            title="Task Board"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title m-b-20">
                                Assigned Employees
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#allocate_employees_to_project"><i class="fa fa-plus"></i> Add employee to this project</a>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-table flex-fill">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped custom-table mb-0 datatable">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>SAP ID</th>
                                                            <th>Email</th>
                                                            <th>Primary phone</th>
                                                            <th>Secondary phone</th>
                                                            <th class="text-right">Action</th>
                                                        </tr>
                                                    </thead>
                                                    @if (count($members)>0)
                                                        @foreach($members as $member)
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <h2 class="table-avatar">
                                                                            <a href="#" class="avatar"><img alt="" src="img/profiles/avatar-19.jpg"></a>
                                                                            <a href="{{route('employees.show', $member)}}">{{$member->name}}</a>
                                                                        </h2>
                                                                    </td>
                                                                    <td>{{$member->sap}}</td>
                                                                    <td>{{$member->email}}</td>
                                                                    <td>{{$member->phone1}}</td>
                                                                    <td>{{$member->phone2}}</td>
                                                                    <td class="text-right">
                                                                        <button class="btn btn-primary" id="re_allocation_btn" role="button" data-toggle="modal" data-target="#project_reallocation_modal" data-id="{{$member->id}}">Re-allocate Employee</button>
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
                        </div>
                    </div>
                    @include('projects.list_files')
                </div>
                <div class="col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title m-b-15">Project details</h6>
                            <table class="table table-striped table-border">
                                <tbody>
                                    <tr>
                                        <td>Client:</td>
                                        <td class="text-right"><a href="{{route('clients.show', $project->client)}}">{{$project->client->name}}</a></td>
                                    </tr>
                                    <tr>
                                        <td>Status:</td>
                                        <td class="text-right @if($project->status_id == 1) text-success @else text-danger @endif">{{$project->status->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Start date:</td>
                                        <td class="text-right">{{$project->start_date}}</td>
                                    </tr>
                                    <tr>
                                        <td>End date:</td>
                                        <td class="text-right">{{$project->end_date}}</td>
                                    </tr>
                                    <tr>
                                        <td>Billing Type:</td>
                                        <td class="text-right">{{$project->billingType ? $project->billingType->name : '--'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Billing Freq:</td>
                                        <td class="text-right">{{$project->billingFrequency ? $project->billingFrequency->name : '--'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Pricing:</td>
                                        <td class="text-right">{{$project->currency->name}} {{$project->pricing}}</td>
                                    </tr>



                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="card project-user">
                        <div class="card-body">
                            <h6 class="card-title m-b-20">Assigned Leader <button type="button"
                                    class="float-right btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#assign_leader"><i class="fa fa-plus"></i> Add</button></h6>
                            <ul class="list-box">
                                <li>
                                    <a href="profile">
                                        <div class="list-item">
                                            <div class="list-left">
                                                <span class="avatar"><img alt=""
                                                        src="img/profiles/avatar-11.jpg"></span>
                                            </div>
                                            <div class="list-body">
                                                <span class="message-author">Wilmer Deluna</span>
                                                <div class="clearfix"></div>
                                                <span class="message-content">Team Leader</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="profile">
                                        <div class="list-item">
                                            <div class="list-left">
                                                <span class="avatar"><img alt=""
                                                        src="img/profiles/avatar-01.jpg"></span>
                                            </div>
                                            <div class="list-body">
                                                <span class="message-author">Lesley Grauer</span>
                                                <div class="clearfix"></div>
                                                <span class="message-content">Team Leader</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Assign Leader Modal -->
        <div id="assign_leader" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Assign Leader to this project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group m-b-30">
                            <input placeholder="Search to add a leader" class="form-control search-input" type="text">
                            <span class="input-group-append">
                                <button class="btn btn-primary">Search</button>
                            </span>
                        </div>
                        <div>
                            <ul class="chat-user-list">
                                <li>
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar"><img alt=""
                                                    src="img/profiles/avatar-09.jpg"></span>
                                            <div class="media-body align-self-center text-nowrap">
                                                <div class="user-name">Richard Miles</div>
                                                <span class="designation">Web Developer</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar"><img alt=""
                                                    src="img/profiles/avatar-10.jpg"></span>
                                            <div class="media-body align-self-center text-nowrap">
                                                <div class="user-name">John Smith</div>
                                                <span class="designation">Android Developer</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="" src="img/profiles/avatar-16.jpg">
                                            </span>
                                            <div class="media-body align-self-center text-nowrap">
                                                <div class="user-name">Jeffery Lalor</div>
                                                <span class="designation">Team Leader</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Assign Leader Modal -->

        <!-- Assign User Modal -->
        <div id="assign_user" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Assign the user to this project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group m-b-30">
                            <input placeholder="Search a user to assign" class="form-control search-input" type="text">
                            <span class="input-group-append">
                                <button class="btn btn-primary">Search</button>
                            </span>
                        </div>
                        <div>
                            <ul class="chat-user-list">
                                <li>
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar"><img alt=""
                                                    src="img/profiles/avatar-09.jpg"></span>
                                            <div class="media-body align-self-center text-nowrap">
                                                <div class="user-name">Richard Miles</div>
                                                <span class="designation">Web Developer</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar"><img alt=""
                                                    src="img/profiles/avatar-10.jpg"></span>
                                            <div class="media-body align-self-center text-nowrap">
                                                <div class="user-name">John Smith</div>
                                                <span class="designation">Android Developer</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="" src="img/profiles/avatar-16.jpg">
                                            </span>
                                            <div class="media-body align-self-center text-nowrap">
                                                <div class="user-name">Jeffery Lalor</div>
                                                <span class="designation">Team Leader</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Assign User Modal -->

        <!-- Edit Project Modal -->
        <div id="edit_project" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Project Name</label>
                                        <input class="form-control" value="Project Management" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Client</label>
                                        <select class="select">
                                            <option>Global Technologies</option>
                                            <option>Delta Infotech</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Rate</label>
                                        <input placeholder="$50" class="form-control" value="$5000" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <select class="select">
                                            <option>Hourly</option>
                                            <option selected>Fixed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Priority</label>
                                        <select class="select">
                                            <option selected>High</option>
                                            <option>Medium</option>
                                            <option>Low</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Add Project Leader</label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Team Leader</label>
                                        <div class="project-members">
                                            <a class="avatar" href="#" data-toggle="tooltip" title="Jeffery Lalor">
                                                <img alt="" src="img/profiles/avatar-16.jpg">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Add Team</label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Team Members</label>
                                        <div class="project-members">
                                            <a class="avatar" href="#" data-toggle="tooltip" title="John Doe">
                                                <img alt="" src="img/profiles/avatar-02.jpg">
                                            </a>
                                            <a class="avatar" href="#" data-toggle="tooltip" title="Richard Miles">
                                                <img alt="" src="img/profiles/avatar-09.jpg">
                                            </a>
                                            <a class="avatar" href="#" data-toggle="tooltip" title="John Smith">
                                                <img alt="" src="img/profiles/avatar-10.jpg">
                                            </a>
                                            <a class="avatar" href="#" data-toggle="tooltip" title="Mike Litorus">
                                                <img alt="" src="img/profiles/avatar-05.jpg">
                                            </a>
                                            <span class="all-team">+2</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea rows="4" class="form-control" placeholder="Enter your message here"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Upload Files</label>
                                <input class="form-control" type="file">
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Project Modal -->


           <!-- Allocate Employees Modal to Project-->

        <div id="allocate_employees_to_project" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Select employees to allocate to the {{$project->name}} project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('employee_project.allocate_employees', $project)}}"  method="POST">
                            @csrf
                            <div class="form-group project-duallist">
                                <label class="text-success" for="">Tip: use 'ctrl'+click or click and drag to select multiple</label>
                                <div class="row">
                                    <div class="col-lg-5 col-sm-5">
                                        <select name="edit_customleave_from" id="edit_customleave_select" class="form-control form-select" size="5" multiple="multiple">
                                    @forelse ($employees as $pro_employee)
                                        <option value="{{$pro_employee->id}}">{{$pro_employee->name}}</option>
                                    @empty
                                        <option value="">No options! Contact Admin</option>
                                    @endforelse
                                </select>
                                    </div>
                            <div class="multiselect-controls col-lg-2 col-sm-2 d-grid gap-2">
                                <button type="button" id="edit_customleave_select_rightAll" class="btn w-100 btn-white"><i class="fa fa-forward"></i></button>
                                <button type="button" id="edit_customleave_select_rightSelected" class="btn w-100 btn-white"><i class="fa fa-chevron-right"></i></button>
                                <button type="button" id="edit_customleave_select_leftSelected" class="btn w-100 btn-white"><i class="fa fa-chevron-left"></i></button>
                                <button type="button" id="edit_customleave_select_leftAll" class="btn w-100 btn-white"><i class="fa fa-backward"></i></button>
                            </div>
                            <div class="col-lg-5 col-sm-5">
                                <select name="employee_ids[]" id="edit_customleave_select_to" class="form-control form-select" size="8" multiple="multiple">
                                    @forelse ($project->employees as $pro_employee)
                                    <option value="{{$pro_employee->id}}">{{$pro_employee->name}}</option>
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
      <!-- /Allocate Employees Modal to Project-->
        @include('projects.re_allocate_emp')
    </div>
    <!-- /Page Wrapper -->
@endsection
