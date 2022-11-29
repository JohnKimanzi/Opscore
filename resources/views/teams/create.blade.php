@extends('layouts.smart-hr', ['title' => 'Add Teams'])
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Create Team</h3>
                    </div>
                </div>
            </div>
            <div class="container">
		<form method='POST' action="{{ route('teams.store') }}">
			@csrf
			<div class="form-group">
				<label for="code">Team Name</label>
				<input type="text" name="name" value="" class='form-control'>
			</div>
            <div class="form-group">
				<label for="code">Team Description</label>
				<input type="text" name="description" value="" class='form-control'>
			</div>
            <div class="form-group">
				<label for="code">Team Lead</label>
                <select class="form-control" name="team_lead_id" id="">
                    <option value="" selected> </option>
                    @forelse ($employees as $team_lead)
                        <option value="{{$team_lead->id}}">{{$team_lead->name}}</option>
                    @empty
                        <option value="">No options! Contact Admin</option>
                    @endforelse
                </select>
			</div>
			<input type="submit" value="Submit" class="btn btn-primary">
		</form>
   </div>
		</div>
	</div>
@endsection
