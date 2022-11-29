@extends('layouts.smart-hr', ['title'=>'Employees'])
@section('content')

<div class="page-wrapper" id="app">
	<div class="content container-fluid">

		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">{{$currentEmployee->first_name." ".$currentEmployee->last_name}}</h3>
					<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Hrms</li>
					<li class="breadcrumb-item active">Edit employee details</li>
					</ul>
				</div>
                <div class="col-auto float-right ml-auto">
                    {{-- <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a> --}}
                    <a href="{{route('employees.index')}}" class="btn add-btn" ><i class="fa fa-bars"></i> Employee list</a>
                    <a href="{{route('employees.create')}}" class="btn add-btn" ><i class="fa fa-plus"></i> Add employee</a>
                    <div class="view-icons">
                        <a href="#" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                        <a href="#" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
			</div>
		</div>

        <edit-employee
            :current="{{$currentEmployee}}"
            :employees="{{$employees}}"
            :genders="{{$genders}}"
            :marital_statuses="{{$marital_statuses}}"
            :countries="{{$countries}}"
            :statuses="{{$statuses}}"
            :marital_statuses="{{$marital_statuses}}"
            :contracts="{{$contract_types}}"
            :education_levels="{{$education_levels}}"
            :departments="{{$departments}}"
            :designations="{{$designations}}"
            :projects="{{$projects}}"
            :groups="{{$blood_groups}}"
            :disability="{{$disability}}"
            :health="{{$health}}"
            :languages="{{$languages}}"
            :currencies="{{$currencies}}"
        ></edit-employee>
    </div>
</div>

@endsection
@section('custom_js')
    <script src="{{ mix('/js/app.js') }}"></script>
@endsection
