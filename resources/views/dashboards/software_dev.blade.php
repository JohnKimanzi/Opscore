@extends('layouts.smart-hr', ['title' => 'User Dashboard'])
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
                            @php
                                function greetingWord()
                                {
                                    $hour = date('G');
                                
                                    if ($hour > 0 && $hour < 24) {
                                        if ($hour >= 3 && $hour < 12) {
                                            echo 'Good Morning';
                                        } elseif ($hour >= 12 && $hour < 17) {
                                            echo 'Good afternoon';
                                        } else {
                                            echo 'Good evening';
                                        }
                                    }
                                }
                            @endphp

                        <h3 class="page-title"><span> {{greetingWord()}}, {{ Auth::user()->name }}</span></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
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
                                        <a href="#"><img alt=""
                                                src="{{ asset('light-theme/img/profiles/userAvatar.jpg') }}"></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ $employee->name }}</h3>
                                                <p class="text-muted">SAP:{{ $employee->sap }} |
                                                    {{ $employee->designation->name }} |
                                                    {{ $employee->project->name }}</p>
                                                <div class="staff-msg"><a class="btn btn-custom"
                                                        href="mailto:{{ $employee->work_email }}">Send
                                                        Email</a></div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Birth Date:</div>
                                                    <div class="text"><a
                                                            href=""></a>{{ date('d M Y', strtotime($employee->dob)) }}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Primary phone:</div>
                                                    <div class="text"><a href=""></a>
                                                        @if ($employee->phone1 != null)
                                                            {{ $employee->phone1 }}
                                                        @else
                                                            --
                                                        @endif
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Secondary phone:</div>
                                                    <div class="text"><a href=""></a>
                                                        @if ($employee->phone2 != null)
                                                            {{ $employee->phone2 }}
                                                        @else
                                                            --
                                                        @endif
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Personal email:</div>
                                                    <div class="text"><a href=""></a>
                                                        @if ($employee->personal_email != null)
                                                            {{ $employee->personal_email }}
                                                        @else
                                                            --
                                                        @endif
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Work email:</div>
                                                    <div class="text"><a href=""></a>
                                                        @if ($employee->work_email != null)
                                                            {{ $employee->work_email }}
                                                        @else
                                                            --
                                                        @endif
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="title">Address:</div>
                                                    <div class="text">
                                                        {{ $employee->residence ? $employee->residence : '--' }} </div>
                                                </li>
                                                <li>
                                                    <div class="title">Marital Status:</div>
                                                    <div class="text">&nbsp;{{ $employee->marital_status->name }}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Gender</div>
                                                    <div class="text">
                                                        &nbsp;{{ $employee->gender ? $employee->gender->name : '--' }}
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon"
                                        href="#"><i class="fa fa-pencil"></i></a></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card tab-box">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item"><a href="#emp_profile" data-toggle="tab"
                                    class="nav-link active">Profile</a></li>
                        </ul>
                    </div>
                </div>
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
                        <form action="{{ route('employees.update', $employee) }}" method="POST"
                            onsubmit="confirm('Are you sure you want to save these changes? \n Once saved, this action can not be undone!')">
                            @csrf
                            @method('PUT')
                            <input type="text" hidden name="section" value="personal_info">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="profile-img-wrap edit-img">
                                        <img class="inline-block"
                                            src="{{ asset('light-theme/img/profiles/userAvatar.jpg') }}" alt="user">
                                        <div class="fileupload btn">
                                            <span class="btn-text">edit</span>
                                            <input class="upload" type="file" name="profile_pic">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>SAP ID</label>
                                                <input type="text" class="form-control" readonly
                                                    value="{{ $employee->sap }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->first_name }}" name="first_name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->middle_name }}" name="middle_name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $employee->last_name }}" name="last_name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Birth Date</label>
                                                <div class="cal-icon">
                                                    <input class="form-control datetimepicker" type="text"
                                                        value="{{ (new Carbon($employee->dob))->format('dd/mm/Y') }}"
                                                        name="dob">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Marital Status</label>
                                                <select class='select' id="" name="marital_status_id">
                                                    <option selected value="{{ $employee->marital_status_id }}">
                                                        {{ $employee->marital_status->name }}</option>
                                                    @foreach (App\Models\MaritalStatus::all() as $marital_status)
                                                        <option value="{{ $marital_status->id }}">
                                                            {{ $marital_status->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class='select' id="" name="gender_id">
                                                    <option selected value="{{ $employee->gender_id }}">
                                                        {{ $employee->gender->name }}</option>
                                                    @foreach (App\Models\Gender::all() as $gender)
                                                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select class='select' id="" name="country_id">
                                                    <option selected value="{{ $employee->country_id }}">
                                                        {{ $employee->country->name }}</option>
                                                    @foreach (App\Models\Country::all() as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Primary Phone Number</label>
                                        <input type="text" class="form-control" value="{{ $employee->phone1 }}"
                                            name="phone1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Secondary Phone Number</label>
                                        <input type="text" class="form-control" value="{{ $employee->phone2 }}"
                                            name="phone2">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Personal email</label>
                                        <input type="text" class="form-control"
                                            value="{{ $employee->personal_email }}" name="personal_email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>work email</label>
                                        <input type="text" class="form-control" value="{{ $employee->work_email }}"
                                            name="work_email">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Permanent Address</label>
                                        <input type="text" class="form-control"
                                            value="{{ $employee->permanent_address }}" name="permanent_address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Residence</label>
                                        <input type="text" class="form-control" value="{{ $employee->residence }}"
                                            name="residence">
                                    </div>
                                </div>
                                {{-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Languages</label>
                                        @foreach ($employee->languages as $lang)
                                            <input type="text" class="form-control"
                                                value="{{ $employee->languages->first()->name ? implode(',', $employee->languages->pluck('name')->toArray()) : '--' }}"
                                                name="language">
                                        @endforeach
                                    </div>
                                </div> --}}
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn" role="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Edit  /Profile Modal -->
    </div>
    <!-- /Page Wrapper -->
@endsection
