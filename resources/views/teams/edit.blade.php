@extends('layouts.smart-hr', ['title' => 'Teams'])
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Edit Team</h3>
                    </div>
                </div>
            </div>
            <div class="container">
		<form method='POST' action="{{route('teams.update', $team)}}">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for="code">Team Name</label>
				<input type="text" name="name" value="{{$team->name}}" class='form-control'>
			</div>
            <div class="form-group">
				<label for="code">Team Description</label>
				<input type="text" name="description" value="{{$team->description}}" class='form-control'>
			</div>
			<div class="form-group">
				<label for="code">Team Lead</label>

				<select class='select' id="" name="team_lead_id">
					<option selected value="{{$team->leads->first()->employee->id}}">{{$team->leads->first()->employee->name ?? 'No Team Lead selected'}}</option>
					@foreach (App\Models\Employee::all() as $emps)
						<option value="{{$emps->id}}">{{$emps->name}}</option>
					@endforeach
				</select>
			</div>
				<input type="submit" value="Submit" class="btn btn-primary">
			</form>
	</div>
		</div>
	</div>
@endsection


