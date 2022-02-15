<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\SendMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function index()
    {
        return view('chat');
    }

    public function sendMessage(Request $request)
    {
        event(new SendMessage($request->username, $request->message));
    }

    public function saveMessage(array $data)
    {
        $message = new Message();
        $message->from_id = auth()->id();
        $message->to_id = $data['to_id'];
        $message->body = $data['body'];
        $message->attachment = $data['attachment'];
    }
}
