<?php

namespace App\Http\Livewire\Chat;

use App\Events\SendMessage;
use App\Repo\ChatRepo as Repo;
use App\Http\Controllers\ChatController as Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public int $authId;
    public string $username = '';
    public string $message = '';
    public array $messages = [];
    public array $users = [];
    public array $user;
    public $attachment = null;

    protected $listeners = [
        'incomeingMessage' => 'receiveMessage',
        'userUpdated' => 'fetchMessages',
    ];

    protected $rules = [
        'message' => 'required|min:1',
        'attachment' => 'nullable|mimes:jpeg,bmp,png,jpg,gif,svg|max:2048',
    ];

    public function mount()
    {
        Auth::user()->update([
            'is_online' => true,
            'last_active' => now()
        ]);
        $this->authId = Auth::user()->id;
        $this->users = Repo::getContacts();
        $this->messages = $this->user ? Repo::getMessages($this->user['id']) : [];
    }

    public function updatedUser()
    {
        // $this->fetchMessages();
    }

    public function receiveMessage($event)
    {
        if ($event['message']['from_id'] == $this->user['id'] && $event['message']['to_id'] == $this->authId) {
            array_push($this->messages, $event['message']);
            $this->emit('receivedMessage');
        }
        if ($event['message']['to_id'] == $this->authId && $event['message']['from_id'] != $this->user['id']) {
            $sender_name = User::find($event['message']['from_id'])->name;

            $notify = [
                "title" => "New Message from {$sender_name}",
                "message" => $event['message']['body'],
            ];
            $this->emit('notifyForMessage', $notify);
        }
    }


    public function selectUser($contact_id)
    {
        $this->user = User::find($contact_id)->toArray();
        $this->emit('userUpdated', route('chat.active', $this->user['id']));
        $this->fetchMessages();
        $this->fetchContacts();
    }

    public function fetchMessages()
    {
        $this->messages = Repo::getMessages($this->user['id']);
        $this->emit('messageLoaded', 0);
    }

    public function fetchContacts()
    {
        $this->users = Repo::getContacts();
    }

    public function sendMessage()
    {
        $this->validate();

        $attachment = null;

        $data = [
            'to_id' => $this->user['id'],
            'body' => $this->message,
            'attachment' => $attachment,
        ];

        $message = Repo::saveMessage($data);

        if ($message) {
            array_push($this->messages, $message);
            $this->message = '';
            $this->emit('sendMessage');
            $this->fetchContacts();
            event(new SendMessage($message->to_id, $message));
        }
    }

    public function render()
    {
        return view('livewire.chat.chat');
    }
}
