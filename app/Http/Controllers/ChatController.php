<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function index()
    {
        return view('chat');
    }

    public function activeChat($userId)
    {
        $activeUser = User::find($userId)->toArray();
        return view('chat', ['activeUser' => $activeUser]);
    }

    public function sendMessage($user_id, $message)
    {
        event(new SendMessage($user_id, $message));
    }
}
