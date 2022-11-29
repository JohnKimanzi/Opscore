<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('users.index', ['users'=>User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules= array(
            // 'name'=>'required|string',
            // 'email'=>'required|string|unique:users',
            // 'password'=>'required|string|confirmed|min:8',
            // 'role'=>'required|string',
            // 'state_id'=>'nullable|numeric|max:100|min:0',
            // 'address'=>'required|string',
            // 'phone1'=>'required|string|unique:users',
            // 'phone2'=>'required|string|unique:users',
            // 'dob'=>'required|date|before:yesterday',
            // 'gender'=>'required|string',
            // 'team_id'=>'nullable|numeric|max:100|min:0',
        );//Include town/city of residence and country for non-us guys
            // dd($request);
        try {
            $this->validate($request, $rules);
        } catch (\Throwable $th) {
            dd($th) ;
        }
        

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>$request->role,
            'state_id'=>$request->state_id,
            'address'=>$request->address,
            'phone1'=>$request->phone1,
            'phone2'=>$request->phone2,
            'dob'=>date('Y-m-d', strtotime($request->dob)),
            'gender'=>$request->gender,
            'team_id'=>$request->gender,
        ]);
        $result=DB::table('users')->find('email');

        if($result=true){
            return Redirect::back()->with('success', 'User has been added');
        }
        return Redirect::back()->with('fail', 'Check your data');

       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        return view('users.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.show', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules= array(
            'name'=>'required|string',
            'email'=>'required|string|unique:users',
            'password'=>'nullable|string|confirmed|min:8',
            'role'=>'required|string',
            'state_id'=>'required|numeric|max:100|min:0',
            'address'=>'required|string',
            'phone1'=>'required|string|unique:users',
            'phone2'=>'required|string|unique:users',
            'dob'=>'required|date|before:yesterday',
            'gender'=>'required|string'
        );//Include town/city of residence and country for non-us guys
        $this->validate($request, $rules);

        $user->name=$request->name;
        $user->email=$request->email;
        $user->role=$request->role;
        $user->state_id=$request->state_id;
        $user->address=$request->address;
        $user->phone1=$request->phone1;
        $user->phone2=$request->phone2;
        $user->dob=$request->dob;
        $user->gender=$request->gender;
        if (isset($request->password)) {
            $user->password=Hash::make($request->password);
        }

        return Redirect::route('user.show',$user);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();  
        return Redirect::route('users.index')->with('success', 'User has been deleted successfully');
    }
}
