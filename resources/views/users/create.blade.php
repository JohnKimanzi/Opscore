@extends('layouts.smart-hr', ['title' => 'Add Users'])

@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Create User</h3>
                    </div>
                </div>
            </div>
            <div class="container">
            <form method='POST' action="{{ route('users.store') }}">
            @csrf
            <div class="form-group">
               <label for="code">User Name</label>
               <input type="text" name="name" value="" class='form-control' placeholder='User Name'>
            </div>
            <div class="form-group">
               <label for="name">Email</label>
               <input type="text" name="email" value="" class='form-control' placeholder='Email'>
            </div>
            <div class="form-group">
               <label for="name">Password</label>
               <input type="text" name="password" value="" class='form-control' placeholder='Password'>
            </div>
            <div class="form-group">
               <label for="name">Re-Enter Pasword</label>
               <input type="text" name="password1" value="" class='form-control' placeholder='Password'>
            </div>
				@include('inc.user_roles_form')
				@include('inc.user_perms_form')
            <input type="submit" value="Submit" class="btn btn-primary">
         </form>
   </div>
@endsection
