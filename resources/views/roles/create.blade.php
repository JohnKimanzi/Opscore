@extends('layouts.smart-hr', ['title' => 'Add Roles'])
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Create Role</h3>
                    </div>
                </div>
            </div>
            <div class="container">
		<form method='POST' action="{{ route('roles.store') }}">
			@csrf
			<div class="form-group">
				<label for="code">Role Name</label>
				<input type="text" name="name" value="" class='form-control' placeholder='Role Name'>
			</div>
			@include('inc.role_perms_form')
			<input type="submit" value="Submit" class="btn btn-primary">
		</form>
   </div>
		</div>
	</div>
@endsection
