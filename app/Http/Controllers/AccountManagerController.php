<?php

namespace App\Http\Controllers;

use App\Models\AccountManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AccountManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'employee_id'=>'required|string',
        ]);
        AccountManager::create([
            'employee_id'=>$request->employee_id,
        ]);
        return Redirect::back()->with('success', 'Done!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountManager  $accountManager
     * @return \Illuminate\Http\Response
     */
    public function show(AccountManager $accountManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountManager  $accountManager
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountManager $accountManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountManager  $accountManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountManager $accountManager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountManager  $accountManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountManager $accountManager)
    {
        //
    }
}
