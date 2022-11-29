@extends('layouts.smart-hr', ['title' => 'Users'])
@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Users</h3>
                        {{ Breadcrumbs::render('users.index') }}

                    </div>
                    @can('Manage Users')
                        <div class="col-auto float-right ml-auto">
                            @if (request()->has('view_deleted'))
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">View All Users</a>
                                {{-- <a href="{{ route('users.restore.all') }}" class="btn btn-success">Restore All</a> --}}
                            @else
                            @if(\App\Models\User::onlyTrashed()->exists())
                                <a href="{{ route('users.index', ['view_deleted' => 'DeletedRecords']) }}"
                                    class="btn btn-danger">View Deleted Users</a>
                            @endif
                            @endif
                            <a href="{{ route('users.create') }}" class="btn add-btn mr-1 ml-1"><i class="fa fa-plus"></i> Add
                                User</a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card-body">
                    @if (count($users))
                        <table id="users" class="table table-hover table-responsive-sm table-sm compact">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ implode(',', $user->roles->pluck('name')->toArray())}}</td>
                                        <td>{{ $user->created_at->toFormattedDateString() }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @can('Manage Users')
                                                        <a class="dropdown-item"
                                                            href="{{ route('users.show', ['user' => $user]) }}"
                                                            title="View User Details"><i class="fa fa-eye m-r-5"></i>View
                                                            user</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('users.edit', ['user' => $user->id]) }}"
                                                            title="Edit User Details"><i class="fa fa-pencil m-r-5"></i>Edit</a>
                                                        <button type="button" class="dropdown-item"
                                                            onclick="if(confirm('Really deactivate this user?')) event.preventDefault(); document.getElementById('ban-user-from-{{ $user->id }}').submit()">
                                                            <i class="fa fa-ban" title="Ban"></i>
                                                            Deactivate</button>
                                                        <form id="ban-user-from-{{ $user->id }}"
                                                            action="{{ route('users.ban', [$user->id]) }}" method="POST"
                                                            style="display: none">
                                                            @csrf
                                                            @method('PUT')
                                                        </form>
                                                        @if ($user->trashed())
                                                            <a class="dropdown-item"
                                                                href="{{ route('users.restore', $user->id) }}"><i
                                                                    class="la la-undo"></i> Restore
                                                                </a>
                                                                <a class="dropdown-item"
                                                                href="{{ route('users.forcedelete', $user->id) }}"><i
                                                                    class="la la-trash"></i> Remove</a>
                                                        @else
                                                            <form method="post"
                                                                action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                                                class="dropdown-item" style="display:inline;">@csrf
                                                                @method('DELETE') <a
                                                                    onclick="if(confirm('Really delete this user?')) { this.parentNode.submit(); }"
                                                                    title="Delete this User"><i class="fa fa-trash-o m-r-5"
                                                                        style="color:red;"> Delete</i></a></form>
                                                        @endcan
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    </table>
                @else
                    <center>No Records Found...</center>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_js')
    <script>
        $(document).ready(function() {
                    $('#users').DataTable({
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
                })
    </script>
@endsection
