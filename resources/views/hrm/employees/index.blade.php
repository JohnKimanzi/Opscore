@extends('layouts.smart-hr', ['title' => 'Employees'])
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">HRMS</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">HRMS</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        {{-- <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a> --}}
                        @can('Manage Employees')
                            <a href="{{ route('export_employees') }}" class="btn add-btn btn-sm"><i class="fa fa-download"></i>
                                Export records</a>
                            <a href="{{ route('employees.create') }}" class="btn add-btn btn-sm"><i class="fa fa-plus"></i> Add
                                Employee</a>
                            <div class="col-auto float-right ml-auto">
                                @if (request()->has('view_deleted'))
                                    <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-sm">All
                                        Employees</a>
                                    {{-- <a href="{{ route('employees.restore.all') }}" class="btn btn-success btn-sm">Restore
                                        All</a> --}} 
                                @else
                                @if(\App\Models\Employee::onlyTrashed()->exists())
                                    <a href="{{ route('employees.index', ['view_deleted' => 'DeletedRecords']) }}"
                                        class="btn btn-danger btn-sm">Employees on attrition</a>
                                @endif
                                @endif
                            </div>
                        @endcan
                        <div class="view-icons">
                            <a href="#" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="#" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <!-- Search Filter -->
            {{-- <form action="{{ url('search') }}" method="POST">

                @csrf


                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                        {{ Session()->get('error') }}
                    </div>
                @endif
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input name="sap" type="text" class="form-control floating">
                            <label class="focus-label">Staff SAP</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input name="employee_name" type="text" class="form-control floating">
                            <label class="focus-label">Staff Name</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <select name="designation" class="form-control floating">
                                <option>--select-options--</option>
                                @foreach ($designations = App\Models\Designation::orderby('name', 'asc')->get() as $designation)
                                    <option>{{ $designation->name }}</option>
                                @endforeach>
                            </select>
                            <label class="focus-label">Designation</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="submit" class="btn btn-success btn-block-sm"> Search</button>
                    </div>
                </div>
            </form> --}}
            <!-- Search Filter -->
            <div class="row staff-grid-row">
                <div class="col-12">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="table" class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>SAP</th>
                                        <th>Country</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Project</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td> <a
                                                    href="{{ route('employees.show', $employee) }}">{{ $employee->name }}</a>
                                            </td>
                                            <td>{{ $employee->sap }} </td>
                                            <td>{{ $employee->country->name }}</td>
                                            <td>{{ $employee->department->name }}</td>
                                            <td>{{ $employee->designation->name }}</td>
                                            <td>{{ $employee->project->name }}</td>

                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="{{ route('employees.show', $employee) }}"><i
                                                                class="fa fa-eye m-r-5"></i> View</a>
                                                        {{-- <a class="dropdown-item" href="{{route('employees.edit', $employee)}}"><i class="fa fa-pencil m-r-5"></i> Edit</a> --}}
                                                        @if ($employee->trashed())
                                                            <a class="dropdown-item"
                                                                href="{{ route('employees.restore', $employee->id) }}"><i
                                                                    class="la la-undo"></i> Restore</a>
                                                                    <a class="dropdown-item" style="color:red;
                                                                href="{{ route('employees.forcedelete', $employee->id) }}"><i
                                                                    class="la la-trash"></i> Permanent delete</a>
                                                        @else
                                                                <button id="disable_employee" class="dropdown-item"
                                                                    href="#"
                                                                    data-toggle="modal"
                                                                    data-emp_id='{{ $employee->id }}'
                                                                    data-target="#delete_employee">
                                                                    <i class="fa fa-trash-o m-r-5"> Disable</i>
                                                                </button>

                                                            {{-- <form method="post"
                                                            action="{{ route('employees.destroy', ['employee' => $employee->id]) }}"
                                                            class="dropdown-item">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="#" class="btn" data-toggle="modal" data-target="#delete_employee"><i  class="fa fa-trash-o m-r-5"></i> Disable</a> --}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <span style="text-align:center">{{$employees->links("pagination::bootstrap-4")}}</span> --}}

        </div>
        <!-- /Page Content -->

        <!-- Add Employee Modal -->

        <!-- /Add Employee Modal -->

        <!-- Edit Employee Modal -->

        <!-- /Edit Employee Modal -->

        <!-- Delete Employee Modal -->
        <div class="modal custom-modal fade" id="delete_employee" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('employees.destroy', $employee) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="form-header">
                                <h3>Delete Employee</h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                                <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Attrition Type
                                        <span class="text-danger">*</span></label>
                                        <select class="select" class='form-control' name="attri_type">
                                            <option>Relieved</option>
                                            <option>End of Contract</option>
                                            <option>Employee deactivated</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" id="employee_id_input" name="employee_id"
                                            value="{{ $employee->id }}" class='form-control' hidden>
                                        <label class="col-form-label">Reason for attrition</label>
                                        <input class="form-control @error('reason') is-invalid @enderror"
                                            type="text" name="attri_reason">
                                    </div>
                                </div>
                                </div>

                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary continue-btn">Disable</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal"
                                            class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Employee Modal -->
    </div>
    <!-- /Page Wrapper -->
@endsection
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

            // $('#delete-project').on('click', function() {
            //     var form = $(this).closest("form");
            //     event.preventDefault();
            //     swal({
            //             title: "Are you sure?",
            //             text: "Once deleted, you will not be able to recover this project!",
            //             icon: "warning",
            //             buttons: true,
            //             dangerMode: true,
            //         })
            //         .then((willDelete) => {
            //             if (willDelete) {
            //                 form.submit();
            //             } else {
            //             }
            //         });
            // });

        })
    </script>
@endsection
@push('scripts')
    <script>
        $('body').on('click', '#disable_employee', function() {
            $("#delete_employee #employee_id_input").val($(this).data('emp_id'));
        });
    </script>
@endpush
