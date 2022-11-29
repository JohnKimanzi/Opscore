<table  class="table table-striped custom-data-table mb-0 ">
    <thead>
        <tr>
            <th>Staff ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>All Roles</th>
            <th>Phone #</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($role->users as $user)
            <tr><td>{{$user->id}}</td>
                <td><a href="{{route('users.show',$user->id)}}"> {{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <td>{{implode(', ', $user->roles()->pluck('name')->toArray())}}</td>
                <td>{{$user->phone1}}</td>
                <td class="text-right">
                    <div class="dropdown dropdown-action">
                        <form method="POST" action="{{ route('revoke_role')}}">
                            @csrf
                            <input type="text" hidden name="user_id" id="user_id" value="{{$user->id}}">
                            <input type="text" hidden name="role_id" id="role_id" value="{{$role->id}}">
                        <button type="submit" class="btn btn-success">Revoke Role</button>
                        </form>
                    </div>
                </td>
        @endforeach
    </tbody>
</table>
