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
                        <h3 class="page-title">{{ $team->name }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Teams</a></li>
                            <li class="breadcrumb-item active">{{ $team->name }}</li>
                        </ul>
                        <div class="btn-toolbar float-right mt-0">
                            <a href="#" class="btn add-btn mr-2" data-toggle="modal" data-target="#allocate_employees_to_team"><i class="fa fa-plus"></i> Add employee to this team</a>
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#allocate_team_leads_to_team"><i class="fa fa-plus"></i> Add team lead to this team</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Leave Statistics -->
            <div class="row">
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>All members</h6>
                        <h4>{{ $members->count() }}</h4>
                    </div>
                </div>
            </div>
            <!-- /Leave Statistics -->

            <!-- Search Filter -->

            <!-- /Search Filter -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Project</th>
                                    <th>Message</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $member)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile" class="avatar"><img alt=""
                                                        src="img/profiles/user.jpg"></a>
                                                <a href="#">{{ $member->name }} </a>
                                            </h2>
                                        </td>
                                        <td>{{ $member->phone1 }}</td>
                                        <td><a href="mailto: $member->work_email">{{ $member->work_email }}</td>
                                        <td>{{ $member->project->name }}</td>
                                        <td class="text-info"><i class="la la-comments [&#xf086;]"></i>SMS</td>
                                        <td class="text-right">
                                            <button class="btn btn-primary" id="re_allocation_btn" role="button" data-toggle="modal" data-target="#team_reallocation_modal" data-id="{{$member->id}}">Re-allocate</button>
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
            <!-- Allocate Employees Modal to Team-->
            <div id="allocate_employees_to_team" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> Select employees to allocate to the {{$team->name}} team</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('employee_team.allocate_employees', $team)}}"  method="POST">
                                @csrf
                        <div class="form-group team-duallist">
                            <label class="text-success" for="">Tip: use 'ctrl'+click or click and drag to select multiple</label>
                            <div class="row">
                                <div class="col-lg-5 col-sm-5">
                                    <select name="edit_customleave_from" id="edit_customleave_select" class="form-control form-select" size="5" multiple="multiple">
                                        @forelse ($add_emp_to_team as $team_employee)
                                            <option value="{{$team_employee->id}}">{{$team_employee->name}}</option>
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
                                @forelse ($team->members as $team_employee)
                                <option value="{{$team_employee->id}}">{{$team_employee->name}}</option>
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
            <!-- /Allocate Employees Modal to Team-->

              <!-- Allocate Team Leads Modal to Team-->
              {{-- <div id="allocate_team_leads_to_team" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> Select Team Leads to allocate to the {{$team->name}} team</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('team-leads_team.allocate_employees', $team)}}"  method="POST">
                                @csrf
                        <div class="form-group lead-duallist">
                            <label class="text-success" for="">Tip: use 'ctrl'+click or click and drag to select multiple</label>
                            <div class="row">
                                <div class="col-lg-5 col-sm-5">
                                    <select name="edit_customleave_from" id="edit_customleave_select" class="form-control form-select" size="5" multiple="multiple">
                                        @forelse ($add_teamlead_to_team as $emp)
                                            <option value="{{$emp->id}}">{{$emp->name}}</option>
                                        @empty
                                            <option selected value="">No options! Contact Admin</option>
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
                                @forelse ($team->leads as $emp)
                                <option value="{{$emp->id}}">{{$emp->name}}</option>
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
            </div> --}}
              <div id="allocate_team_leads_to_team" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> Select Team Leads to allocate to the {{$team->name}} team</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('team-leads_team.allocate_employees', $team)}}"  method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="text-success" for="">Tip: use 'ctrl'+click or click and drag to select multiple</label>
                                    <select class="form-control" name="employee_ids[]" id="" required multiple>
                                        @forelse ($add_teamlead_to_team as $emp)
                                            <option value="{{$emp->id}}">{{$emp->name}}</option>
                                        @empty
                                            <option selected value="">No options! Contact Admin</option>
                                        @endforelse
                                    </select>
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
            <!-- /Allocate Team Leads Modal to Team-->
            @include('teams.re_allocate_team')
    </div>
    <!-- /Page Wrapper -->
@endsection
