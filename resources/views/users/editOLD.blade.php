@extends('layouts.smart-hr', ['title'=>'Users'])
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
	 <form method='POST' action="{{route('users.update', $user)}}">
		@csrf
		@method('PUT')
		<div class="form-group">
			<label for="name">User Name</label>
			<input type="text" name="name" value="{{$user->name}}" class='form-control' placeholder='User Name'>
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" name="email" value="{{$user->email}}" class='form-control' placeholder='Email'>
		</div>
		<div class="form-group">
			<label for="password">Old Password</label>
			<input type="password" name="password" value="{{$user->password}}" class='form-control' placeholder='Old Password'>
		</div>
		<div class="form-group">
			<label for="password1">New Password</label>
			<input type="text" name="password1" class='form-control' placeholder='Enter new Password'>
		</div>
		@include('inc.user_roles_form')
		@include('inc.user_perms_form')
		<input type="submit" value="submit" class="btn btn-primary">
	</form>
	</div>
	</div>
</div>
@endsection

@section('js')
<script>
$('#roles').DataTable({
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
	@stop

	@push('js')
