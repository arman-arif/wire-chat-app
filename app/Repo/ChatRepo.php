<?php

namespace App\Repo;

use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatRepo
{
    public static function saveMessage(array $data)
    {
        $message             = new Message();
        $message->from_id    = Auth::user()->id;
        $message->to_id      = $data['to_id'];
        $message->body       = $data['body'];
        $message->attachment = $data['attachment'];
        $message->save();

        return $message;
    }

    public static function getMessages($contact_id)
    {
        $messages = Message::where(function ($query) use ($contact_id) {
            $query->where('from_id', Auth::user()->id)->where('to_id', $contact_id);
        })
            ->orWhere(function ($query) use ($contact_id) {
                $query->where('from_id', $contact_id)->where('to_id', Auth::user()->id);
            })
            // ->where('created_at', '>=', Carbon::now()->subMinutes(10)->format('Y-m-d H:i:s'))
            ->orderByDesc('created_at')
            ->limit(30)
            ->get()
            // ->makeHidden(['updated_at'])
            // ->map(function ($message) {
            //     $message->time = strtotime($message->created_at);
            //     return $message;
            // })
            ->sortByDesc('created_at')
            ->toArray();

        return array_reverse($messages);
    }

    public function getMoreMessages($contact_id, $msg_ids)
    {
        $messages = Message::where(function ($query) use ($contact_id) {
            $query->where('from_id', Auth::user()->id)->where('to_id', $contact_id);
        })
            ->orWhere(function ($query) use ($contact_id) {
                $query->where('from_id', $contact_id)->where('to_id', Auth::user()->id);
            })
            // ->where('created_at', '>=', Carbon::now()->subMinutes(10)->format('Y-m-d H:i:s'))
            ->whereNotIn('id', $msg_ids)
            ->orderByDesc('created_at')
            ->limit(30)
            ->get()
            // ->makeHidden(['updated_at'])
            // ->map(function ($message) {
            //     $message->time = strtotime($message->created_at);
            //     return $message;
            // })
            ->sortByDesc('created_at')
            ->toArray();

        return array_reverse($messages);
    }

    public static function getContacts()
    {
        return User::addSelect([
            'last_message_at' => Message::select(DB::raw('MAX(messages.created_at) as last_message_at'))
                ->whereColumn('users.id', 'messages.from_id')->orWhereColumn('users.id', 'messages.to_id'),
        ])
            ->where(function ($query) {
                $query->whereIn('users.id', Message::select('from_id')->where('to_id', Auth::user()->id)->groupBy('from_id'))
                    ->orWhereIn('users.id', Message::select('to_id')->where('from_id', Auth::user()->id)->groupBy('to_id'));
            })
            ->where('users.id', '!=', Auth::user()->id)
            ->orderby('last_message_at', 'desc')
            ->get()
            ->append(['image_url'])
            ->map(function ($user) {
                $user->last_message = Carbon::parse($user->last_message_at)->diffForHumans();
                $user->online = false;
                return $user;
            })
            ->makeHidden(['email_verified_at', 'image', 'updated_at']);
    }
}
