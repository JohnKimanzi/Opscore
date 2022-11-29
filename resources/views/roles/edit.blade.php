@extends('layouts.smart-hr', ['title' => 'Roles'])
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Edit Role</h3>
                    </div>
                </div>
            </div>
            <div class="container">
		<form method='POST' action="{{route('roles.update', $role->id)}}">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for="code">Role Name</label>
				<input type="text" name="name" value="{{$role->name}}" class='form-control' placeholder='Role Name'>
			</div>
			@include('inc.role_perms_form')
				<input type="submit" value="Submit" class="btn btn-primary">
			</form>
	</div>
		</div>
	</div>
@endsection

@section('js')
<script>
$('#permissions').DataTable({
  "pageLength": 25,
  "paging": true,
  "lengthChange": true,
  "searching": true,
  "ordering": true,
  "info": true,
  "autoWidth": false,
  'columnDefs' : [{
    'targets' : [-1],
    'orderable' : false
   }]
});
</script>
@endsection


