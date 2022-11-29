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
                            <h3 class="page-title"> Appraisal Review</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                                <li class="breadcrumb-item active">Appraisal</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="{{route('my_appraisals')}}" class="btn add-btn" >My Appraisals</a>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="{{route('appraisals.create')}}" class="btn add-btn" ><i class="fa fa-plus"></i>Start Appraisal</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Year</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($need_approvals as $need_approval)
                                    <tr>
                                        <td>{{$need_approval->id}}</td>
                                        <td>
                                            {{$need_approval->employee->first_name}} {{$need_approval->employee->middle_name}} {{$need_approval->employee->last_name}}
                                        </td>
                                        <td>{{$need_approval->employee->department->name}}</td>
                                        <td>{{$need_approval->employee->designation->name}}</td>
                                        <td>{{$need_approval->year}}</td>
                                        <td class="text-right">
                                            <a href="{{route('review',[$need_approval->employee->id,$need_approval->id])}}" class="btn btn-success btn-sm text-light">Review</a>
                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /Page Wrapper -->
@endsection
