<?php

namespace App\Http\Controllers;
use App\Models\Channel;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = Channel::all();
        return view('channels.index', compact('channels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $channels = Channel::all();
        if (Auth::user()->hasAnyRole('Human Resource Manager|Admin|BPO Director|Software developer|Head of Operations|Operations Manager|Human Resouce Manager|Human Resouce Executive')) {
        return view('channels.create')->with('channels', $channels);
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
            'name' => ['required', 'string'],
        );
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return  response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        } else {
            $channel = Channel::create([
                'name' => $request->name,
            ]);
            return  response()->json([
                'status' => true,
                'message' => 'Channel has been created successfully!'
            ]);
        }
        return  response()->json([
            'status' => false,
            'message' => 'Channel not created!'
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
        $channel = Channel::findOrFail($id);
        return view('channels.show', ['channel' => $channel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        $channels = Channel::all();
        if (Auth::user()->hasAnyRole('Human Resource Manager|Admin|BPO Director|Head of Operations|Operations Manager|Human Resouce Manager|Human Resouce Executive')) {
            return view('channels.edit')
                ->with('channels', $channels)->with('channel', $channel);
        }
        return abort(403, 'Unauthorized');
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
        $channel = Channel::findOrFail($id);
        if($channel){
            $channel->name = $request->name;
            $channel->save();
            // return back()->with('success', 'channel updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'Channel updated successfully!',
            ]);
        }else{
        return  response()->json([
            'status' => false,
            'message' => 'Channel not found!'
        ]);
    }}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request, Channel $channel, Subscription $sub){
        $request->validate([
            'subscribable_type'=>['string','required'],
            'subscribable_id'=>['numeric','required'],

        ]);
        $sub = Subscription::firstOrCreate(
            [
                'channel' => $channel->channel->id,
                'subscribable_type' => $sub->Subscription->type,
                'subscribable_id' => $sub->Subscription->id,
            ]
        );
        return abort(403, 'Unauthorized');
    }
    public function destroy(Channel $channel)
    {
        if ($channel->delete()) {
            return redirect()->route('channels.index')->with('success', 'Channel deleted successfully');
        }
        return redirect()->route('channels.index')->with('error', 'Channel not deleted');
    }
}
