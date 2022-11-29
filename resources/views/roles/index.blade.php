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
                        <h3 class="page-title">Roles</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">roles</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{ route('roles.create') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add Role</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="card-body">
                    <div class="justify-content-center">
                        @if (count($roles))
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped custom-table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $role)
                                                <tr>
                                                    <td>{{ $role->id }}</td>
                                                    <td><a href="{{route('roles.show', $role)}}">{{ $role->name }}</a></td>
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle"
                                                                data-toggle="dropdown" aria-expanded="false"><i
                                                                    class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('roles.show', $role) }}"><i
                                                                        class="fa fa-eye m-r-5"></i> View</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('roles.edit', ['role' => $role->id]) }}"><i
                                                                        class="fa fa-pencil m-r-5"></i> Edit</a>
                                                                <form
                                                                    action="{{ route('roles.destroy', ['role' => $role->id]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')<a
                                                                        onclick="if(confirm('Really delete this role?')) { this.parentNode.submit(); }"
                                                                        title="Delete this Role"></a>
                                                                    <button type="submit" class="dropdown-item"
                                                                        href="#"><i class="fa fa-trash-o m-r-5"></i>
                                                                        Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                            @endforeach
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        @else
                            <center>No Records Found...</center>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#roles').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            'columnDefs': [{
                'targets': [-1],
                'orderable': false
            }]
        });
    </script>
@endsection
