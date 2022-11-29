<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $recipients = User::all();
        return view('chat.chat')
            ->with('recipients', $recipients);
    }

    public function fetchMessages(Request $request)
    {
        // // dd($request->input('user_id'));
        // $senders = User::all();
        // foreach($senders as $sender) {
        // // foreach($request->user_ids as $user_id){
        // //    return Employee::findOrFail($recipient)->update(['team_id'=>$team->id]);
        //     $sender->id = $request->user_id;
        //    return Message::with('user')->where('user_id', $sender->id)->where('recipient', Auth::id())->get();
        // }
        $request->validate([
            'user_ids'=>'required|array',
        ]);
        foreach($request->user_ids as $sender){
           return Message::where('user_id', $sender->id)->where('recipient', Auth::id())->pluck('message');
        };
        // return back()->with('success', "Done!");
    }

    public function sendMessage(Request $request)
    {
        $message =  Auth::user()->messages()->create([
            'message' => $request->message,
            'recipient' => $request->recipient,
        ]);
        return ['status' => 'Message Sent!'];
    }
}
