<?php

namespace App\Http\Controllers;
use App\Models\Channel;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
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
        $subscriptions = Subscription::all();
        $channels = Channel::all();
        if (Auth::user()->hasAnyRole('Human Resource Manager|Admin|BPO Director|Head of Operations|Operations Manager|Human Resouce Manager|Human Resouce Executive')) {
        return view('subscriptions.create')->with('subscriptions', $subscriptions)
                                           ->with('channels', $channels);
        }
        return abort(403, 'Unauthorized');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'subscribable_type' => ['required', 'string'],
            'subscribable_id' => ['required', 'numeric'],
            'channel_id' => ['required', 'string'],
        );
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return  response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        } else {
            $subscription = Subscription::create([
                'subscribable_type' => $request->subscribable_type,
                'subscribable_id' => $request->subscribable_id,
                'channel_id' => $request->channel_id,
            ]);
            return  response()->json([
                'status' => true,
                'message' => 'Subscription has been created successfully!'
            ]);
        }
        return  response()->json([
            'status' => false,
            'message' => 'Subscription not created!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
