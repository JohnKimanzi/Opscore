@extends('layouts.smart-hr', ['title' => 'Add Channel'])
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Create Channel</h3>
                    </div>
                </div>
            </div>
            <div class="container">
		<form method='POST' action="{{ route('channels.store') }}">
			@csrf
			<div class="form-group">
				<label for="code">Channel Name</label>
				<input type="text" name="name" value="" class='form-control' placeholder='Channel Name'>
			</div>
			<input type="submit" value="Submit" class="btn btn-primary">
		</form>
   </div>
		</div>
	</div>
@endsection
