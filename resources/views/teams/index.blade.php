@extends('layouts.smart-hr')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        @include('layouts.partials.flash')
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Teams</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                            <li class="breadcrumb-item active">Teams</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{route('teams.create')}}" class="btn add-btn"><i class="fa fa-plus"></i> Add team</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
        </div>
        <!-- /Page Content -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="table" class="table table-striped custom-table mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Members Count</th>
                                <th>Description</th>
                                <th>Team Leader(s)</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teams as $team)
                            <tr>
                                <td><a href="{{route('teams.show', $team)}}">{{$team->name}}</a></td>
                                <td>{{$team->members->count()}}</td>
                                <td> {{$team->description}}</td>
                                <td>{{implode(',',$team->leads->map->employee->pluck('first_name')->toArray())}}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{route('teams.edit', $team)}}" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <form id="delete-project-form" action="{{route('teams.destroy', $team)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button  id="delete-team" class="dropdown-item" href="#" ><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_js')
<script>

    $(document).ready(function () {

        $('#table').DataTable({
            retrieve: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'colvis'
            ]
        });
    });
</script>
@endsection