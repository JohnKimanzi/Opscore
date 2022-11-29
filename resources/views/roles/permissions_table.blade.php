<table  class="table table-striped custom-data-table mb-0 ">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description </th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($role->permissions as $permission)
            <tr><td>{{$permission->id}}</td>
                <td>{{$permission->name}}</td>
                <td>{{$permission->description}}</td>
                <td class="text-right">
                    <div class="dropdown dropdown-action">
                        <form method="POST" action="{{ route('revoke_permission')}}">
                            @csrf
                            <input type="text" hidden name="permission_id" id="permission_id" value="{{$permission->id}}">
                            <input type="text" hidden name="role_id" id="role_id" value="{{$role->id}}">
                        <button type="submit" class="btn btn-success">Revoke Permission</button>
                        </form>
                    </div>
                </td>
        @endforeach
    </tbody>
</table>
