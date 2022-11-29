@extends('layouts.smart-hr', ['title'=>'Permissions'])
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Permissions</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">permissions</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('permissions.create')}}" class="btn add-btn"><i class="fa fa-plus"></i> Add Permission</a>
                </div>
            </div>
        </div>
            <div class="row justify-content-center">
                <div class="card-body">
                    @if (count($permissions))
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                            @can('Manage Permissions')
                            <a href="{{ route('permissions.edit', ['permission' => $permission->id]) }}" title="Edit Permission Details"><i class="fa fa-pencil m-r-5"></i></a>
                            @endcan
                        </td>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
                @endif
            </div>
            </div>
    </div>
</div>
@endsection
@section('js')
<script>
$('#permissions').DataTable({
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