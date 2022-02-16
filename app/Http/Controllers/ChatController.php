<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\SendMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{

    public function index()
    {
        return view('chat');
    }

    public function sendMessage(Request $request)
    {
        event(new SendMessage($request->to_id, $request->message));
    }

    public static function saveMessage(array $data)
    {
        $message             = new Message();
        $message->from_id    = auth()->id();
        $message->to_id      = $data['to_id'];
        $message->body       = $data['body'];
        $message->attachment = $data['attachment'];
        $message->save();

        return $message;
    }

    public static function getContacts()
    {
        return Message::join('users', function ($join) {
            $join->on('users.id', '=', 'messages.from_id')
                ->orOn('users.id', '=', 'messages.to_id');
        }, 'right')
            ->where(function ($query) {
                $query->where('messages.from_id', auth()->id())
                    ->orWhere('messages.to_id', auth()->id());
            })
            ->whereNot('users.id', auth()->id())
            ->select('users.*')
            ->addSelect(['last_message' => DB::raw('MAX(messages.created_at) as last_message')])
            ->groupBy('users.id')
            ->get();
    }
}
