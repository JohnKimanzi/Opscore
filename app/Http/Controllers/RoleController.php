<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller {

   public function __construct() {
      $this->middleware('auth'); // requires authentication
   }

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$this->check_permission('Manage Roles');

		$roles = Role::all();
		return view('roles.index', compact('roles'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

		$this->check_permission('Manage Roles');

		$permissions = Permission::all();
		return view('roles.create', compact('permissions'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$this->check_permission('Manage Roles');

		$this->validate($request, [
		   'name'       => 'required',
		   'guard_name' => 'nullable'
		]);

		$permissions      = $request->permissions;
		$role             = new Role;
		$role->name       = $request->input('name');
		$role->guard_name = 'web';
		$role->save();

		$permissions = $request->get('permissions', []);
		$role->syncPermissions($permissions);

		return redirect()->route('roles.index')->with('success', 'Role Saved');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Role  $role
	 * @return \Illuminate\Http\Response
	 */
	public function show(Role $role)
	{
	    $permissions = $role->permissions;
		return view('roles.show', [
			'add_emp_to_role'=>User::all(),
			'role'=>$role,
			'permissions'=>$permissions
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Role  $role
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request, int $id) {

		$this->check_permission('Manage Roles');

		$role        = Role::findOrFail($id);
		$permissions = Permission::all();

		return view('roles.edit', compact('role', 'permissions'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Role  $role
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, int $id) {

		$this->check_permission('Manage Roles');

		$role             = Role::findOrFail($id);
		$role->name       = $request->name;
		$role->guard_name = 'web';
		$role->save();

		$permissions = $request->get('permissions', []);
		$role->syncPermissions($permissions);

		return redirect()->route('roles.index')->with('success', 'Role Updated');

	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Role  $role
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Role $role)
	{
	    $role->delete();
		return back()->with('success', 'Role has been deleted successfully');
	}
	public function revoke_role (Request $request, Role $role)
	{
		$request->validate([
         'user_id' => 'required',
		 'role_id' => 'required'
		]);

		$role = Role::findOrFail($request->role_id);
		$user = User::findOrFail($request->user_id);

		$user->removeRole($role);

		return redirect()->back()->with('success', 'User has been removed from Role successfully!');
	}
    public function allocate_user_to_role(Request $request, Role $role){
        $request->validate([
            'user_ids'=>'required|array',
        ]);
        foreach($request->user_ids as $user_id){
            User::findOrFail($user_id)->assignRole($role);
        }
        return back()->with('success', "User added to this role successfully!");
    }
}
