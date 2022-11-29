<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Gender;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
// use ArielMejiaDev\LarapexCharts\LarapexChart;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth'); // requires authentication
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( Request $request)
    {

        if ($request->has('view_deleted')) {
            $users = User::onlyTrashed()->get();
        } else $users = User::all();
        return view('users.index', [
            'users' => $users,
        ]);
        $this->check_permission('Manage Users');

        $users = User::all();
        return view('users.index', compact('users'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{

		$this->check_permission('Manage Users');

		$permissions = Permission::all();
		$roles       = Role::all();

		return view('users.create', compact('permissions', 'roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{

		$this->check_permission('Manage Users');

		$this->validate($request, [
			'name'     => 'bail|required|min:2',
			'email'    => 'required|email|unique:users',
			'password' => 'required|min:6'
		]);

		$user           = new User;
		$user->name     = $request->input('name');
		$user->email    = $request->input('email');
		$user->password = bcrypt($request->input('password'));
		$user->save();

		// Handle the user roles
		$this->syncPermissions($request, $user);

		return redirect()->route('users.index')->with(['success', 'User Saved']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user)
	{
		return view('users.show', ['user'=>$user]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request, int $id)
	{

		$this->check_permission('Manage Users');

		$user             = User::findOrFail($id);
		$permissions      = Permission::all();
		$roles            = Role::all();
		$user_roles       = $user->getRoleNames();
		$user_permissions = $user->getDirectPermissions();

		return view('users.edit', compact(
			'user',
			'roles',
			'permissions',
			'user_roles',
			'user_permissions'
		));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, int $id)
	{

		$user        = User::findOrFail($id);
		$user->name  = $request->name;
		$user->email = $request->email;
		$user->employee_id = $user->employee->id;
		dd($user);
		$user->save();

		return redirect()->route('users.index')->with('success', 'User Updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(int $id)
	{

		$this->check_permission('Manage Users');

		if (auth()->user()->id == $id) {
			return Redirect::route('users.index')->with('success', 'Current user cannot be deleted');
		}

		if (User::findOrFail($id)->delete()) {
			return Redirect::route('users.index')->with('success', 'User Deleted succesfully');
		}
	}

	public function blockUser(Request $request)
	{
		$user = User::findOrFail($request->user);
		$user->blocked_at = Carbon::now();
		$user->save();

		return Redirect()->route('users.index')->with('User has been blocked');
	}


	public function restore($id)
	{
		User::withTrashed()->find($id)->restore();
		return redirect()->route('users.index');
	}
	public function restoreAll()
	{
		User::onlyTrashed()->restore();
		return redirect()->route('users.index');

	}
    public function forcedelete()
	{
		User::onlyTrashed()->forceDelete();
		return redirect()->route('users.index');
	}

	private function syncPermissions(Request $request, $user)
	{

		// submitted roles / permissions
		$roles       = $request->get('roles', []);
		$permissions = $request->get('permissions', []);

		// Get the roles
		$roles = Role::find($roles);

		// check for current role changes
		if (!$user->hasAllRoles($roles)) {

			// reset all direct permissions for user
			// Bob - I have a potential problem with this - but we'll leave it for now
			$user->permissions()->sync([]);
		} else {
			// handle permissions
			$user->syncPermissions($permissions);
		}

		$user->syncRoles($roles);

		return $user;
	}

	public function chart()
	{

        $userM   = Employee::where('gender_id', 1)->count();
        $userF = Employee::where('gender_id', 2)->count();

        $chart = LarapexChart::setType('bar')
			->setTitle('TBL Gender Distribution')
            // ->setLabels([Gender::find(1)->name, Gender::find(2)->name])
			->setXAxis(['Male', 'Female'])
            ->setDataset([
				[
					'name' => 'Male',
					'data' => [$userM],
					'xaxis' => ['labels' => 'Male']
				], 
				[
					'name' => 'Female',
					'data' => [$userF],
					'xaxis' => ['labels' => 'Female']
				]
			])
			// ->setDataLabels(true)
			->setWidth(400)
			->setColors(['#ffc73c', '#f5746f']);
			// ->setOptions(['xaxis'=> ['labels' => ['show' => false]]]);

		// dd($chart->width());
        return view('tests.chart2', compact('chart'));
	}
	public function user_gen_chart()
	{
		$employees = Employee::all();
		$m_count = $employees->where('gender_id', 1)->count();
		$f_count = $employees->where('gender_id', 2)->count();
		// $test_chart_vue = view('tests.chart-vue', [
		// 	'm_count'=>$m_count,
		// 	'f_count'=>$f_count
		// ])->render();
		// dd($f_count);
		return response()->json([$m_count, $f_count]);
	}
}
