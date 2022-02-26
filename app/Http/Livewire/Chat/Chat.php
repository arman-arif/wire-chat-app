<?php

namespace App\Http\Livewire\Chat;

use App\Models\User;
use Livewire\Component;
use App\Events\SendMessage;
use App\Repo\ChatRepo as Repo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public int $authId;
    public int $activeId;
    public string $username = '';
    public string $message  = '';
    public $attachment      = null;

    public Collection $users;
    public User $user;
    public array $messages;

    protected $listeners = [
        'incomeingMessage' => 'receiveMessage',
        'userUpdated'      => 'fetchMessages',
        'userLoggedOut'    => 'updateUserStatus',
        'userLoggedIn'     => 'updateUserStatus',
        'send'             => 'sendMessage',
    ];

    protected $rules = [
        'message' => 'required|min:1',
        'attachment' => 'nullable|mimes:jpeg,bmp,png,jpg,gif,svg|max:2048',
    ];

    public function mount()
    {
        $activeUser     = User::find($this->activeId);
        $this->authId   = Auth::user()->id;
        $this->users    = Repo::getContacts();
        $this->user     = $activeUser ? $activeUser : null;
        $this->messages = isset($this->user->id) ? Repo::getMessages($this->user->id) : [];
        Auth::user()->update(['is_online' => true, 'last_active' => now()]);
    }

    public function updatedUser($user, $value)
    {
        $this->fetchMessages();
    }

    public function updatedMessage($message, $value)
    {
        $this->fetchContacts();
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
        $this->user = User::find($contact_id);
        $this->emit('userUpdated', route('chat.active', $this->user['id']));
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

    public function sendMessage($data)
    {
        $this->message = $data['message'];
        $this->validate();

        $attachment = null;

        $data = [
            'to_id' => $this->user['id'],
            'body' => $this->message,
            'attachment' => $attachment,
        ];

        // $this->emitTo('chat.composer', 'sent');

        $message = Repo::saveMessage($data);

        if ($message) {
            array_push($this->messages, $message);
            $this->message = '';
            $this->emit('sentMessage');
            $this->fetchContacts();
            event(new SendMessage($message->to_id, $message));
        }
    }

    function updateUserStatus($event)
    {
        $this->users = Repo::getContacts();
        $this->user = User::find($this->user['id']);
    }

    public function render()
    {
        return view('livewire.chat.chat');
    }
}
