<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Channel;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::all();
        return view('announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $announcements = Announcement::all();
        $channels = Channel::all();
        if (Auth::user()->hasAnyRole(['Human Resource Manager','Group Coordinator','Team Coordinator','Admin','BPO Director','Head of Operations','Operations Manager','Human Resouce Manager','Human Resouce Executive'])) {
        return view('announcements.create')->with('announcements', $announcements)
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
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
            'channel_id' => ['required', 'string'],
        );
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return  response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        } else {
            $announcement = Announcement::create([
                'title' => $request->title,
                'body' => $request->body,
                'channel_id' => $request->channel_id,
                'posted_by' => Auth::user()->name,
            ]);
            return  response()->json([
                'status' => true,
                'message' => 'Announcement has been created successfully!'
            ]);
        }
        return  response()->json([
            'status' => false,
            'message' => 'Announcement not created!'
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
        $announcement = Announcement::findOrFail($id);
        return view('announcements.show', ['announcement' => $announcement]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        $channels = Channel::all();
        $subscribers = Subscription::all();
        $announcements = Announcement::all();
        if (Auth::user()->hasAnyRole('Human Resource Manager|Admin|BPO Director|Head of Operations|Operations Manager|Human Resouce Manager|Human Resouce Executive')) {
            return view('announcements.edit')
                ->with('channels', $channels)
                ->with('subscribers', $subscribers)
                ->with('announcements', $announcements)->with('announcement', $announcement);
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
        $announcement = Announcement::findOrFail($id);
        if($announcement){
            $announcement->title = $request->title;
            $announcement->body = $request->body;
            $announcement->channel_id = $request->channel_id;
            $announcement->posted_by = $request->posted_by;
            $announcement->save();
            // return back()->with('success', 'announcement updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'Announcement updated successfully!',
            ]);
        }
        return  response()->json([
            'status' => false,
            'message' => 'Announcement not found!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        if ($announcement->delete()) {
            return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully');
        }
        return redirect()->route('announcements.index')->with('error', 'Announcement not deleted');
    }
}
