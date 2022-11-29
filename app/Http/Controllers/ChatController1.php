<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Events\ChatMessage;
use App\Models\User;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendMessage(Request $request)
    {
        $message = [
            "id" => $request->userid,
            "sourceuserid" => Auth::user()->id,
            "name" => Auth::user()->name,
            "message" => $request->message
        ];
        event(new ChatMessage($message));
        return "true";
    }

    public function chatPage()
   {
       $users = User::take(10)->get();
       return view('chat.chat',['users'=> $users]);
   }
}
