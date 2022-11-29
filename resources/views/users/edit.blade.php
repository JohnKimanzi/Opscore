@extends('layouts.smart-hr', ['title'=>'Users'])
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h4> Edit User <span class="text-blue">{{$user->name}}</span> </h4>
        </div>
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
		<input type="submit" value="submit" class="btn btn-primary">
        </form>
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
@endsection