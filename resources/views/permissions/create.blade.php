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
            <form method='POST' action="{{ route('permissions.store') }}">
            @csrf
            <div class="form-group">
               <label for="code">Permission Name</label>
               <input type="text" name="name" value="" class='form-control' placeholder='Permission Name'>
            </div>
            <div class="form-group">
               <label for="code">Description</label>
               <textarea name="description" value="" class='form-control' placeholder='Permission Description'></textarea>
            </div>
            <div class="form-group">
               <label for="name">Guard Name</label>
               <input type="text" name="guard_name" value="web" class='form-control'>
            </div>
            <input type="submit" value="Submit" class="btn btn-primary">
         </form>
   </div>
        </div>
    </div>
@endsection
