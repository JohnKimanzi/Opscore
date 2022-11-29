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
                            <h3 class="page-title">Projects</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Projects</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_project"><i class="fa fa-plus"></i> Add project</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <!-- Leave Statistics -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6>All projects</h6>
                            <h4>{{$projects->count()}}</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6>Active projects</h6>
                            <h4>{{$projects->where('status_id', 1)->count()}} <span>Accounts</span></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6>Closed deals</h6>
                            <h4>{{$projects->where('status_id', 3)->count()}} <span>Paid in full</span></h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-info">
                            <h6>Pending projects</h6>
                            <h4>{{$projects->where('status_id', 6)->count()}} <span>Pending accounts</span></h4>
                        </div>
                    </div>

                </div>
                <!-- /Leave Statistics -->

                <!-- Search Filter -->

                <!-- /Search Filter -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="table" class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Project Type</th>
                                        <th>Start-End</th>
                                        <th>Billing Type</th>
                                        <th>Frequency</th>
                                        <th>Currency</th>
                                        <th>Pricing</th>
                                        <th>Seats</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                      <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile" class="avatar"><img alt="" src="img/profiles/user.jpg"></a>
                                                <a href="{{route('projects.show', $project)}}">{{$project->name}} <span>{{$project->client ? $project->client->name : '--'}}</span></a>
                                            </h2>
                                        </td>
                                        <td>{{$project->projectType ? $project->projectType->name : '--'}}</td>
                                        <td>{{$project->start_date.' - '.$project->end_date}} </td>
                                        <td>{{$project->billingType ? $project->billingType->name : '--'}}</td>
                                        <td>{{$project->billingFrequency ? $project->billingFrequency->name : '--'}}</td>
                                        <td>{{$project->currency ? $project->currency->name : '--'}}</td>
                                        <td>{{$project->pricing ? $project->pricing : '--'}}</td>
                                        <td>{{count($project->employees)}} </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{route('projects.edit', $project)}}" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <form id="delete-project-form" action="{{route('projects.destroy', $project)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button  id="delete-project" class="dropdown-item" href="#" ><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
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
                            <form action="{{route('projects.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @include('projects.create')
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Project Modal -->
            <!-- Edit Project Modal -->
            <div id="edit_project" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Project</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('projects.update', 1)}}" method="POST">
                                @csrf
                                @method('Patch')
                                @include('projects.projects_form')
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Project Modal -->

            <!-- Delete project Modal -->

            <!-- /Delete project Modal -->

        </div>
        <!-- /Page Wrapper -->
@endsection

@section('custom_js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {

            $('#table').DataTable({
                retrieve: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'colvis'
                ]
            });

            $('#delete-project').on('click',function () {

                var form =  $(this).closest("form");

                event.preventDefault();

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this project!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {

                            form.submit();

                        } else {


                        }
                    });
            });


        })
    </script>

@endsection
