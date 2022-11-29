@extends('layouts.smart-hr')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">{{$client->name}} Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="card mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    <a href="">
                                        <img src="{{asset('img/client_logos/default.png')}}" alt="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                            <li>
                                                <span class="title">Client Industry: </span>
                                                <span class="text">{{$client->industry->name ?? '--'}}</span>
                                            </li>
                                            <li>
                                                <span class="title">Contact Person:</span>
                                                @if($client->contact_people<>null)
                                                @forelse($client->contact_people as $contact)
                                                <span class="text">{{$contact->first_name. ','.$contact->last_name}} | {{$contact->email}} | {{$contact->designation}}</span>
                                                @empty
                                                <span class="text">No contact person records</span>
                                                @endforelse
                                                @endif
                                            </li>
                                            <li>
                                                <span class="title">Phone:</span>
                                                <span class="text"><a href="">@if($client->phone1<>null && $client->phone2<>null){{$client->phone1.', '.$client->phone2}}@else -- @endif</a></span>
                                            </li>
                                            {{-- <li>
                                                <span class="title">Email:</span>
                                                <span class="text"><a href="">@if($client->email<>null){{$client->email}} @else -- @endif</a></span>
                                            </li> --}}
                                            <li>
                                                <span class="title">Date onboarded:</span>
                                                <span class="text">@if($client->contract_start<>null){{$client->contract_start}} @else -- @endif</span>
                                            </li>
                                            <li>
                                                <span class="title">Contract expiry:</span>
                                                <span class="text">@if($client->contract_expiry<>null){{$client->contract_expiry}} @else -- @endif</span>
                                            </li>
                                            <li>
                                                <span class="title">Town/City:</span>
                                                <span class="text">@if($client->physical_address<>null){{$client->physical_address}} @else -- @endif</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card tab-box">
            <div class="row user-tabs">
                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item col-sm-3"><a class="nav-link active" data-toggle="tab" href="#myprojects">Projects</a></li>
                        <li class="nav-item col-sm-3"><a class="nav-link" data-toggle="tab" href="#tasks">Tasks</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="tab-content profile-tab-content">

                    <!-- Projects Tab -->
                    <div id="myprojects" class="tab-pane fade show active">
                        <div class="row">
                            @if(count($client->projects)>0)
                                @foreach($client->projects as $project)
                                    <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                                        <div class="card border-info">

                                            <div class="card-header bg-info">
                                                <div class="dropdown profile-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{route('projects.edit', $project)}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
                                                <h4 class="project-title"><a href="{{route('projects.show', $project)}}">{{$project->name}} <small>{{$project->location}}</small></a></h4>
                                            </div>
                                            <div class="card-body row">
                                                <div class="col-md-6">
                                                    <div class="pro-deadline m-b-15">
                                                        <div class="sub-title">
                                                            Project Capacity:
                                                        </div>
                                                        <div class="text-muted">
                                                            {{$project->employees->count()}} Seats
                                                        </div>
                                                    </div>
                                                    <div class="pro-deadline m-b-15">
                                                        <div class="sub-title">
                                                            Status:
                                                        </div>
                                                        <div class="text-muted">
                                                            @if($project->status_id == 1)
                                                            <span class="text-success">{{$project->status->name}}</span>
                                                            @else
                                                            <span class="text-danger">{{$project->status?$project->status->name:'-'}}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="pro-deadline m-b-15">
                                                        <div class="sub-title">
                                                            Start date:
                                                        </div>
                                                        <div class="text-muted">
                                                            {{$project->start_date}}
                                                        </div>
                                                    </div>
                                                    <div class="pro-deadline m-b-15">
                                                        <div class="sub-title">
                                                            End date:
                                                        </div>
                                                        <div class="text-muted">
                                                            {{$project->end_date}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                    <div class="pro-deadline m-b-15">
                                                        <div class="sub-title">
                                                            Billing type:
                                                        </div>
                                                        <div class="text-muted">
                                                            {{$project->billing_type}}
                                                        </div>
                                                    </div>
                                                    <div class="pro-deadline m-b-15">
                                                        <div class="sub-title">
                                                            Billing Freq:
                                                        </div>
                                                        <div class="text-muted">
                                                            {{$project->billing_frequency}}
                                                        </div>
                                                    </div>
                                                    <div class="pro-deadline m-b-15">
                                                        <div class="sub-title">
                                                            Billing Currency:
                                                        </div>
                                                        <div class="text-muted">
                                                            {{$project->currency?$project->currency->name:'-'}}
                                                        </div>
                                                    </div>
                                                    <div class="pro-deadline m-b-15">
                                                        <div class="sub-title">
                                                            Pricing:
                                                        </div>
                                                        <div class="text-muted">
                                                            {{$project->pricing}}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="project-members m-b-15 ">
                                                  <hr>
                                                  <div>{{$project->description}}</div>

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                              There are no projects
                            @endif



                        </div>
                    </div>
                    <!-- /Projects Tab -->

                    <!-- Task Tab -->
                    <div id="tasks" class="tab-pane fade">
                        <div class="project-task">
                            <ul class="nav nav-tabs nav-tabs-top nav-justified mb-0">
                                <li class="nav-item"><a class="nav-link active" href="#all_tasks" data-toggle="tab" aria-expanded="true">All Tasks</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pending_tasks" data-toggle="tab" aria-expanded="false">Pending Tasks</a></li>
                                <li class="nav-item"><a class="nav-link" href="#completed_tasks" data-toggle="tab" aria-expanded="false">Completed Tasks</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="all_tasks">
                                    <div class="task-wrapper">
                                        <div class="task-list-container">
                                            <div class="task-list-body">
                                                No tasks
                                            </div>
                                            <div class="task-list-footer">
                                                <div class="new-task-wrapper">
                                                    <textarea  id="new-task" placeholder="Enter new task here. . ."></textarea>
                                                    <span class="error-message hidden">You need to enter a task first</span>
                                                    <span class="add-new-task-btn btn" id="add-task">Add Task</span>
                                                    <span class="btn" id="close-task-panel">Close</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="pending_tasks"></div>
                                <div class="tab-pane" id="completed_tasks"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /Task Tab -->

                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->

@endsection
