@extends('layouts.smart-hr')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Members in the <u>{{$department->name}}</u> Department</h3>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#allocate_employees_to_department"><i class="fa fa-plus"></i> Add employee to this department</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
       <!-- /Page Content -->
       <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped custom-data-table mb-0">
                    <thead>
                        <tr>
                            <th style="width: 30px;">#</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Project</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($department->employees as $l_employee)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$l_employee->name}}</td>
                            <td>{{$l_employee->designation->name}}</td>
                            <td>{{$l_employee->project->name}}</td>
                            <td class="text-right">
                               <button class="btn btn-primary" id="re_allocation_btn" role="button" data-toggle="modal" data-target="#department_reallocation_modal" data-id="{{$l_employee->id}}">Re-allocate Employee</button>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
       </div>
    </div>

        <!-- Allocate Employees Modal to Dept-->
        <div id="allocate_employees_to_department" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Select employees to allocate to the {{$department->name}} department</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('employee_department.allocate_employees', $department)}}"  method="POST">
                            @csrf
                            
                            <div class="form-group leave-duallist">
                                <label>Add employee</label>
                                <div class="row">
                                    <div class="col-lg-5 col-sm-5">
                                        <select name="customleave_from" id="customleave_select" class="form-control form-select" size="5" multiple="multiple">
                                            @forelse ($employees as $l_employee)
                                                <option value="{{$l_employee->id}}">{{$l_employee->name}}</option>
                                            @empty
                                                <option value="">No options! Contact Admin</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="multiselect-controls col-lg-2 col-sm-2 d-grid gap-2">
                                        <button type="button" id="customleave_select_rightAll" class="btn w-100 btn-white"><i class="fa fa-forward"></i></button>
                                        <button type="button" id="customleave_select_rightSelected" class="btn w-100 btn-white"><i class="fa fa-chevron-right"></i></button>
                                        <button type="button" id="customleave_select_leftSelected" class="btn w-100 btn-white"><i class="fa fa-chevron-left"></i></button>
                                        <button type="button" id="customleave_select_leftAll" class="btn w-100 btn-white"><i class="fa fa-backward"></i></button>
                                    </div>
                                    <div class="col-lg-5 col-sm-5">
                                        <select name="employee_ids[]" id="customleave_select_to" class="form-control form-select" size="8" multiple="multiple"></select>
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
        <!-- /Allocate Employees Modal to Dept-->
@include('hrm.departments.re_allocate_emp')
@endsection