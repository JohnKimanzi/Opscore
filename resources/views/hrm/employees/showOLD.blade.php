@extends('layouts.smart-hr', ['title'=>'Employees'])
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
			@include('layouts.partials.flash')
            <!-- Page Content -->
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Employee Profile</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Employee Profile</li>
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
                                            <a href="#"><img alt="" src="{{ asset('light-theme/img/profiles/userAvatar.jpg') }}"></a>
                                        </div>
                                    </div>
                                    <div class="profile-basic">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="profile-info-left">
                                                    <h3 class="user-name m-t-0 mb-0">{{$employee->first_name." ".$employee->other_names}}</h3>
                                                    <h6 class="text-muted">{{$employee->project->name  }}</h6>
                                                    <h6 class="text-muted">{{$employee->first_name  }}</h6>

                                                    <p class="text-muted">{{$employee->designation->name}}</p>
                                                    <div class="staff-id">Employee SAP ID : {{$employee->sap}}</div>

                                                    <div class="small doj text-muted">Birth date : {{date('d M Y', strtotime($employee->dob))}}</div>
                                                    <div class="staff-msg"><a class="btn btn-custom" href="chat">Send Message</a></div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <ul class="personal-info">
                                                    <li>
                                                        <div class="title">Primary phone:</div>
                                                        <div class="text"><a href="">{{$employee->phone1}}</a></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Secondary phone:</div>
                                                        <div class="text"><a href="">{{$employee->phone2}}</a></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Personal email:</div>
                                                        <div class="text"><a href=""></a>{{$employee->personal_email}}</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Work email:</div>
                                                        <div class="text"><a href=""></a>{{$employee->work_email}}</div>
                                                    </li>

                                                    <li>
                                                        <div class="title">Address:</div>
                                                        <div class="text">{{$employee->residence}}</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Gender:</div>
                                                        <div class="text">{{$employee->gender->name}}</div>
                                                    </li>
                                                    {{-- <li>
                                                        <div class="title">Religion</div>
                                                        <div class="text">Undefined</div>
                                                    </li> --}}
                                                    <li>
                                                        <div class="title">Reports to:</div>
                                                        <div class="text">
                                                           <div class="avatar-box">
                                                              <div class="avatar avatar-xs">
                                                                 <img src="img/profiles/avatar-16.jpg" alt="">
                                                              </div>
                                                           </div>

                                                                @if($employee->report_to<>null)
                                                                    <a href="{{route('employees.show', $employee->appraiser)}}">{{$employee->appraiser->first_name}}  {{$employee->appraiser->middle_name}} {{$employee->appraiser->last_name}}</a>
                                                                @else
                                                                    Undefined
                                                                @endif
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card tab-box">
                    <div class="row user-tabs">
                        <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                            <ul class="nav nav-tabs nav-tabs-bottom">
                                <li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile</a></li>
                                <li class="nav-item"><a href="#bank_statutory" data-toggle="tab" class="nav-link">Remuneration details <small class="text-danger">(HR Only)</small></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="tab-content">

                    <!-- Profile Info Tab -->
                    @if(Auth::user()->can('Manage Employees'))
                        <div id="emp_profile" class="pro-overview tab-pane fade show active">
                            <div class="row">
                                <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                            <h3 class="card-title">Employment details <a href="#" class="edit-icon" data-toggle="modal" data-target="#employment_info_modal"><i class="fa fa-pencil"></i></a></h3>
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Employee SAP</div>
                                                    <div class="text">{{$employee->sap}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Department</div>
                                                    <div class="text">{{$employee->department->name}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Project</div>
                                                    <div class="text">@if($employee->project<>null) {{$employee->project->name}} @else Undefined @endif</div>
                                                </li>
                                                <li>
                                                    <div class="title">Designation</div>
                                                    <div class="text">{{$employee->designation->name}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Contract type</div>
                                                    <div class="text">{{$employee->contract->name}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Date of join</div>
                                                    <div class="text">{{$employee->contract_start}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Contract Exp Date.</div>
                                                    <div class="text">{{$employee->contract_expiry}}</div>
                                                </li>

                                                <li>
                                                    <div class="title">Team</div>
                                                    <div class="text">@if($employee->team<>null){{$employee->team->name}} @else Undefined @endif</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                            <h3 class="card-title">Statutory Information <a href="#" class="edit-icon" data-toggle="modal" data-target="#statutory_info_modal"><i class="fa fa-pencil"></i></a></h3>
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Nationality</div>
                                                    <div class="text">{{$employee->country->name}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">ID No.</div>
                                                    <div class="text">{{$employee->national_id}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Huduma No.</div>
                                                    <div class="text">{{$employee->huduma_number}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Passport No.</div>
                                                    <div class="text">{{$employee->passport_number}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Passport Exp Date.</div>
                                                    <div class="text">{{'N/A'}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">KRA PIN.</div>
                                                    <div class="text">{{$employee->kra_pin}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">NHIF No.</div>
                                                    <div class="text">{{$employee->nhif}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">NSSF No.</div>
                                                    <div class="text">{{$employee->nssf}}</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                            <h3 class="card-title">Bank information <a href="#" class="edit-icon" data-toggle="modal" data-target="#bank_info_modal"><i class="fa fa-pencil"></i></a></h3>
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Bank name</div>
                                                    <div class="text">{{$employee->bank_name}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Branch Name</div>
                                                    <div class="text">{{$employee->bank_branch}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Branch Code</div>
                                                    <div class="text">{{$employee->branch_code}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Account name</div>
                                                    <div class="text">{{$employee->account_name}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Bank account No.</div>
                                                    <div class="text">{{$employee->account_number}}</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                            <h3 class="card-title">Family Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#family_info_modal"><i class="fa fa-pencil"></i></a></h3>
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Marital status</div>
                                                    <div class="text">Undefined</div>
                                                </li>
                                            </ul>
                                            <div class="table-responsive">
                                                <table class="table table-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Relationship</th>
                                                            <th>Date of Birth</th>
                                                            <th>Phone</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Leo</td>
                                                            <td>Brother</td>
                                                            <td>Feb 16th, 2019</td>
                                                            <td>9876543210</td>
                                                            <td class="text-right">
                                                                <div class="dropdown dropdown-action">
                                                                    <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                                        <a href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                            <h3 class="card-title">Next-of-kin <a href="#" class="edit-icon" data-toggle="modal" data-target="#emergency_contact_modal"><i class="fa fa-pencil"></i></a></h3>
                                            @if ($employee->nextOfKins->count()<1)
                                                No records
                                            @else
                                                @foreach ($employee->nextOfKins as $next_of_kin)
                                                    <h5 class="section-title">{{$loop->iteration}}.</h5>
                                                    <ul class="personal-info">
                                                        <li>
                                                            <div class="title">Name</div>
                                                            <div class="text">{{$next_of_kin->full_name}}</div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Relationship</div>
                                                            <div class="text">{{$next_of_kin->relationship}}</div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Phone </div>
                                                            <div class="text">{{$next_of_kin->phone1}}, {{$next_of_kin->phone2}}</div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Relationship</div>
                                                            <div class="text">{{$next_of_kin->email}}</div>
                                                        </li>
                                                    </ul>
                                                    <hr>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                            <h3 class="card-title">Education <a href="#" class="edit-icon" data-toggle="modal" data-target="#education_info"><i class="fa fa-pencil"></i></a></h3>
                                            <div class="experience-box">
                                                <ul class="experience-list">
                                                    @if($employee->educations->count()<1)
                                                        No records
                                                    @else
                                                        @foreach ($employee->educations as $edu)
                                                            <li>
                                                                <div class="experience-user">
                                                                    <div class="before-circle"></div>
                                                                </div>
                                                                <div class="experience-content">
                                                                    <div class="timeline-content">
                                                                        <a href="#/" class="name">{{$edu->institution}}</a>
                                                                        <div>{{$edu->institution. " - ".$edu->institution." - ".$edu->score}}</div>
                                                                        <span class="time">{{$edu->start_date." - ".$edu->end_date}}</span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="card profile-box flex-fill">
                                        <div class="card-body">
                                            <h3 class="card-title">Work Experience <a href="#" class="edit-icon" data-toggle="modal" data-target="#experience_info"><i class="fa fa-pencil"></i></a></h3>
                                            <div class="experience-box">
                                                <ul class="experience-list">
                                                    @if($employee->experiences->count()<1)
                                                        No records
                                                    @else
                                                        @foreach($employee->experiences as $xp)
                                                        <li>
                                                                <div class="experience-user">
                                                                    <div class="before-circle"></div>
                                                                </div>
                                                                <div class="experience-content">
                                                                    <div class="timeline-content">
                                                                        <a href="#" class="name">{{$xp->position." at ".$xp->company_name}}</a>
                                                                        <span class="time">{{$xp->start_date}} - {{$xp->start_date}} ({{(new Carbon($xp->start_date))->diffForHumans(new Carbon($xp->end_date))}})</span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    @endif

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- /Profile Info Tab -->

                    <!-- Bank Statutory Tab -->
                    @role('Human Resource Manager')
                        <div class="tab-pane fade" id="bank_statutory">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"> Basic Salary Information</h3>
                                    <form>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Contract type <span class="text-danger">*</span></label>
                                                    <input class='form-control' type="text" disabled value="{{$employee->contract->name}}">

                                            </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Gross pay <small class="text-muted">per month</small></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Ksh</span>
                                                        </div>
                                                        <input type="text" class="form-control"  value="0.00">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Net pay <small class="text-muted">per month</small></label>
                                                    <input class='form-control' type="text" disabled value="0.00">

                                            </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3 class="card-title"> Statutory Contributions</h3>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">KRA PIN</label>
                                                    <input class='form-control' type="text" disabled value="{{$employee->kra_pin}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Monthly contribution. <span class="text-danger">*</span></label>
                                                    <input class='form-control' type="text" disabled value="1050">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">NHIF number</label>
                                                    <input class='form-control' type="text" disabled value="{{$employee->nhif}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Monthly contribution. <span class="text-danger">*</span></label>
                                                    <input class='form-control' type="text" disabled value="500">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">NSSF number</label>
                                                    <input class='form-control' type="text" disabled value="{{$employee->nssf}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Monthly contribution. <span class="text-danger">*</span></label>
                                                    <input class='form-control' type="text" disabled value="200">

                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Total monthly deductions</label>
                                                    <input class='form-control' type="text" disabled value="{{$employee->nssf}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-form-label">Monthly contribution. <span class="text-danger">*</span></label>
                                                    <input class='form-control' type="text" disabled value="200">

                                                </div>
                                            </div>
                                        </div>


                                        <div class="submit-section">
                                            <button class="btn btn-primary submit-btn" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endrole
                    <!-- /Bank Statutory Tab -->

                </div>
            </div>
            <!-- /Page Content -->

            <!-- Edit Profile Modal -->
            <div id="profile_info" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Profile Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('employees.update', $employee)}}" method="POST" onsubmit="confirm('Are you sure you want to save these changes? \n Once saved, this action can not be undone!')">
                                @csrf
                                @method('PUT')
                                <input type="text" hidden name="section" value="personal_info" >
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-img-wrap edit-img">
                                            <img class="inline-block" src="{{ asset('light-theme/img/profiles/userAvatar.jpg') }}" alt="user">
                                            <div class="fileupload btn">
                                                <span class="btn-text">edit</span>
                                                <input class="upload" type="file" name="profile_pic">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>SAP ID</label>
                                                    <input type="text" class="form-control" readonly value="{{$employee->sap}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" value="{{$employee->first_name}}" name="first_name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Middle Name</label>
                                                    <input type="text" class="form-control" value="{{$employee->middle_name}}" name="middle_name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" value="{{$employee->last_name}}" name="last_name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Birth Date</label>
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker" type="text" value="{{(new Carbon($employee->dob))->format('dd/mm/Y')}}" name="dob">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select class="select form-control" name="gender">
                                                        <option selected value="{{$employee->gender->name}}">{{$employee->gender->name}}</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select class='select' id="" name="country_id">
                                                <option selected value="{{$employee->country_id}}">{{$employee->country->name}}</option>
                                                @foreach (App\Models\Country::all() as $country)
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Primary Phone Number</label>
                                            <input type="text" class="form-control" value="{{$employee->phone1}}" name="phone1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Secondary Phone Number</label>
                                            <input type="text" class="form-control" value="{{$employee->phone2}}" name="phone2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Personal email</label>
                                            <input type="text" class="form-control" value="{{$employee->personal_email}}" name="personal_email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Work email</label>
                                            <input type="text" class="form-control" value="{{$employee->work_email}}" name="work_email">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Permanent Address</label>
                                            <input type="text" class="form-control" value="{{$employee->permanent_address}}" name="permanent_address">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Residence</label>
                                            <input type="text" class="form-control" value="{{$employee->residence}}" name="residence">
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" role="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--Edit  /Profile Modal -->

            <!-- Employment Info Modal -->
            <div id="employment_info_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Employment Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('employees.update', $employee)}}" method="POST" onsubmit="confirm('Are you sure you want to save these changes? \n Once saved, this action can not be undone!')">
                                @csrf
                                @method('PUT')
                                <input type="text" hidden name="section" value="employment_info" >
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>SAP ID</label>
                                            <input type="text" class="form-control" value="{{$employee->sap}}" name="sap">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Department</label>
                                            <select class='select' id="" name="department_id">
                                                <option selected value="{{$employee->department_id}}">{{$employee->department->name}}</option>
                                                @foreach (App\Models\Department::all() as $d)
                                                    <option value="{{$d->id}}">{{$d->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Project</label>
                                            <select class='select' id="" name="project_id">
                                                <option selected value="{{$employee->project_id}}">{{$employee->project->name}}</option>
                                                @foreach (App\Models\Project::all() as $p)
                                                    <option value="{{$p->id}}">{{$p->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Team</label>
                                            <select class='select' id="" name="team_id" required>
                                                @if(!isset($employee->team))
                                                    <option value="" selected>--select--</option>
                                                @endif
                                                @if(isset($employee->team))
                                                    <option selected value="{{$employee->team_id}}">{{$employee->team->name}}</option>
                                                @endif
                                                @foreach (App\Models\Team::all() as $t)
                                                    <option value="{{$t->id}}">{{$t->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <select class='select' id="" name="designation_id">
                                                <option selected value="{{$employee->designation_id}}">{{$employee->designation->name}}</option>
                                                @foreach (App\Models\Designation::all() as $d)
                                                    <option value="{{$d->id}}">{{$d->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contract Type</label>
                                            <select class='select' id="" name="contract_id">
                                                <option selected value="{{$employee->contract_id}}">{{$employee->contract->name}}</option>
                                                @foreach (App\Models\Contract::all() as $c)
                                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of Join</label>
                                            <div class="cal-icon">
                                                <input class="form-control datetimepicker" type="text" value="{{(new Carbon($employee->contract_start))->format('dd/mm/Y')}}" name="contract_start">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contract Expiry</label>
                                            <div class="cal-icon">
                                                <input class="form-control datetimepicker" type="text" value="{{(new Carbon($employee->contract_expiry))->format('dd/mm/Y')}}" name="contract_expiry">
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" role="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Employment Info Modal -->

            <!-- Statutory Info Modal -->
            <div id="statutory_info_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Statutory Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('employees.update', $employee)}}" method="POST" onsubmit="confirm('Are you sure you want to save these changes? \n Once saved, this action can not be undone!')">
                                @csrf
                                @method('PUT')
                                <input type="text" hidden name="section" value="statutory_info" >
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>National ID</label>
                                            <input type="text" class="form-control" value="{{$employee->national_id}}" name="national_id">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Passport No</label>
                                            <input type="text" class="form-control" value="{{$employee->passport_number}}" name="passport_number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Huduma No</label>
                                            <input type="text" class="form-control" value="{{$employee->huduma_number}}" name="huduma_number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Passport Expiry Date</label>
                                            <div class="cal-icon">
                                                <input type="text" readonly value="{{(new Carbon())->format('dd/mm/Y')}}" class="form-control floating datetimepicker">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>KRA PIN <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" value="{{$employee->kra_pin}}" name="kra_pin">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NHIF <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" value="{{$employee->nhif}}" name="nhif">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NSSF <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" value="{{$employee->nssf}}" name="nssf">
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" role="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Statutory Info Modal -->

            <!-- Bank Info Modal -->
            <div id="bank_info_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Bank Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('employees.update', $employee)}}" method="POST" onsubmit="confirm('Are you sure you want to save these changes? \n Once saved, this action can not be undone!')">
                                @csrf
                                @method('PUT')
                                <input type="text" hidden name="section" value="bank_info" >
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bank Name</label>
                                            <input type="text" class="form-control" value="{{$employee->bank_name}}" name="bank_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Branch Name</label>
                                            <input type="text" class="form-control" value="{{$employee->bank_branch}}" name="bank_branch">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Branch Code</label>
                                            <input type="text" class="form-control" value="{{$employee->branch_code}}" name='branch_code'>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Account Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" value="{{$employee->account_name}}" name='account_name'>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Account Number <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" value="{{$employee->account_number}}" name='account_number'>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" role="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Bank Info Modal -->

            <!-- Family Info Modal -->
            <div id="family_info_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> Family Informations</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-scroll">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Marital status <span class="text-danger">*</span></label>
                                                    <select class="select form-control">
                                                        <option>-</option>
                                                        <option>Single</option>
                                                        <option>Married</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Employment of spouse</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No. of children </label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <h3 class="card-title">Family Member <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Relationship <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Date of birth <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Phone <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Relationship <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Date of birth <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Phone <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-more">
                                                <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Family Info Modal -->

            <!-- Next-of-kin Modal -->
            <div id="emergency_contact_modal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Next-of-kin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('employees.update', $employee)}}" method="POST" onsubmit="confirm('Are you sure you want to save these changes? \n Once saved, this action can not be undone!')">
                                @csrf
                                @method('PUT')
                                <input type="text" hidden name="section" value="next_of_kin" >
                                @foreach ($employee->nextOfKins as $kin)
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">{{$loop->iteration}}</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" value="{{$kin->full_name}}" name="kin_name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Relationship <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" value="{{$kin->relationship}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Primary phone <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Secondary phone <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" role="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Emergency Contact Modal -->

            <!-- Education Modal -->
            <div id="education_info" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> Education backgound</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('employees.update', $employee)}}" method="POST" onsubmit="confirm('Are you sure you want to save these changes? \n Once saved, this action can not be undone!')">
                                @csrf
                                @method('PUT')
                                <input type="text" hidden name="section" value="education" >
                                <div class="form-scroll">
                                    @foreach ($employee->educations as $edu )
                                        <div class="card">
                                            <div class="card-body">
                                                <h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <input type="text" value="{{$edu->institute}}" class="form-control floating">
                                                            <label class="focus-label">Institution</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <input type="text" value="{{$edu->level}}" class="form-control floating">
                                                            <label class="focus-label">Subject</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <div class="cal-icon">
                                                                <input type="text" value="{{(new Carbon($edu->start_date))->format('dd/mm/Y')}}" class="form-control floating datetimepicker">
                                                            </div>
                                                            <label class="focus-label">Starting Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <div class="cal-icon">
                                                                <input type="text" value="{{(new Carbon($edu->end_date))->format('dd/mm/Y')}}" class="form-control floating datetimepicker">
                                                            </div>
                                                            <label class="focus-label">Completion Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <input type="text" value="{{$edu->undertaking}}" class="form-control floating">
                                                            <label class="focus-label">Degree</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-focus focused">
                                                            <input type="text" value="{{$edu->score}}" class="form-control floating">
                                                            <label class="focus-label">Score</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Education Modal -->

            <!-- Experience Modal -->
            <div id="experience_info" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Experience Informations</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('employees.update', $employee)}}" method="POST" onsubmit="confirm('Are you sure you want to save these changes? \n Once saved, this action can not be undone!')">
                                @csrf
                                @method('PUT')
                                <input type="text" hidden name="section" value="work_experience" >
                                <div class="form-scroll">
                                    @foreach ($employee->experiences as $xp)
                                       <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Experience Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <input type="text" class="form-control floating" value="{{$xp->company_name}}" name="company_name">
                                                        <label class="focus-label">Company Name</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <input type="text" class="form-control floating" value="{{$xp->position}}" name="position">
                                                        <label class="focus-label">Job Position</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <input type="text" class="form-control floating" value="{{$xp->reason_for_leaving}}" name='reason_for_leaving'>
                                                        <label class="focus-label">Reason fo leaving</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <div class="cal-icon">
                                                            <input type="text" value="{{(new Carbon($xp->start_date))->format('dd/mm/Y')}}" class="form-control floating datetimepicker" name="start_date">
                                                        </div>
                                                        <label class="focus-label">Period From</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <div class="cal-icon">
                                                            <input type="text" value="{{(new Carbon($xp->end_date))->format('dd/mm/Y')}}" class="form-control floating datetimepicker" name="end_date">
                                                        </div>
                                                        <label class="focus-label">Period To</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <textarea class="form-control" name='duties_performed' cols="30" rows="5">{{$xp->duties_performed}}</textarea>

                                                        <label class="focus-label">Duties performed</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" role="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Experience Modal -->

        </div>
        <!-- /Page Wrapper -->
@endsection
