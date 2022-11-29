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
                        <h3 class="page-title">Clients</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Clients</a></li>
                            <li class="breadcrumb-item active">Clients</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_client"><i
                                class="fa fa-plus"></i> Add Client</a>
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
                        <h6>All clients</h6>
                        <h4>{{ $clients->count() }}</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>Active clients</h6>
                        <h4>{{ $clients->where('status_id', 1)->count() }} <span>Accounts</span></h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>Closed deals</h6>
                        <h4>{{ $clients->where('status_id', 3)->count() }} <span>Previous clients</span></h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>Prospective deals</h6>
                        <h4>{{ $clients->where('status_id', 7)->count() }} <span>prospective clients</span></h4>
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
                                    <th>Client name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Contract duration</th>
                                    <th>Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile" class="avatar"><img alt=""
                                                        src="/img/userAvartar.jpg"></a>
                                                <a href="{{ route('clients.show', $client) }}">{{ $client->name }}
                                                    <span>{{ $client->physical_address }}</span></a>
                                            </h2>
                                        </td>
                                        <td>{{ $client->phone1 }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->contract_start . ' - ' . $client->contract_expiry }} </td>
                                        <td>{{ $client->status->name }} </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('clients.edit', $client) }}"><i
                                                            class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <form id="delete-project-form"
                                                        action="{{ route('clients.destroy', $client) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button id="delete-project" class="dropdown-item" href="#"><i
                                                                class="fa fa-trash-o m-r-5"></i> Delete</button>
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
                        <form action="{{ route('clients.store') }}" method="POST">
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

        <!-- Edit Client Modal -->
        <div id="edit_client" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Client</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            @csrf
                            @method('PUT')
                            @include('clients.client_form')
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Client Modal -->
    </div>
    <!-- /Page Wrapper -->
@endsection
{{-- @section('name', 'content')
        <script>
            // $('#id=client_edit').action='{{route('clients.update',)}}'
        </script>
@endsection --}}

@section('custom_js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {

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

            $('#delete-project').on('click', function() {

                var form = $(this).closest("form");

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
