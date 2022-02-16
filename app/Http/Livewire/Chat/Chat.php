<?php

namespace App\Http\Livewire\Chat;

use App\Events\SendMessage;
use App\Http\Controllers\ChatController as Repo;

use Livewire\Component;

class Chat extends Component
{
    public int|null $user_id = null;
    public string $username = '';
    public string $message = '';
    public array $messages = [];
    public array $users = [];
    public array $user;
    public $attachment = null;

    protected $rules = [
        'message' => 'required|min:1',
        'attachment' => 'nullable|mimes:jpeg,bmp,png,jpg,gif,svg|max:2048',
    ];

    public function mount()
    {
        $this->messages = [
            (object) ['id' => "fjdkfj34", 'from_id' => 1, 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar1.png', 'body' => 'Hello, how are you?', 'created_at' => '2020-01-01 00:00:00',],
            (object) ['id' => "fjdkfj3442", 'from_id' => 2, 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar2.png', 'body' => 'Hello, how are you?', 'created_at' => '2020-01-01 00:00:00',],
            (object) ['id' => "fjdkfj54545", 'from_id' => 2, 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar2.png', 'body' => 'Hello, how are you?', 'created_at' => '2020-01-01 00:00:00',],
            (object) ['id' => "fjdkfj234234", 'from_id' => 1, 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar1.png', 'body' => 'Hello, how are you?', 'created_at' => '2020-01-01 00:00:00',],
            (object) ['id' => "fjdkfj9859", 'from_id' => 2, 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar2.png', 'body' => 'Hello, how are you?', 'created_at' => '2020-01-01 00:00:00',],
            (object) ['id' => "fjdkfj65646", 'from_id' => 1, 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar1.png', 'body' => 'Hello, how are you?', 'created_at' => '2020-01-01 00:00:00',],
        ];

        $this->users = [
            (object) ['id' => 1, 'name' => 'John Doe', 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar1.png', 'online' => true, 'last_active' => '2022-02-15 07:20:43',],
            (object) ['id' => 2, 'name' => 'John Doe', 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar2.png', 'online' => true, 'last_active' => '2022-02-15 07:20:43',],
            (object) ['id' => 3, 'name' => 'John Doe', 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar3.png', 'online' => false, 'last_active' => '2022-02-15 08:20:43',],
            (object) ['id' => 4, 'name' => 'John Doe', 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar4.png', 'online' => false, 'last_active' => '2022-02-15 08:20:43',],
            (object) ['id' => 1, 'name' => 'John Doe', 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar1.png', 'online' => true, 'last_active' => '2022-02-15 07:20:43',],
            (object) ['id' => 5, 'name' => 'John Doe', 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar2.png', 'online' => true, 'last_active' => '2022-02-15 07:20:43',],
            (object) ['id' => 3, 'name' => 'John Doe', 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar3.png', 'online' => false, 'last_active' => '2022-02-15 08:20:43',],
            (object) ['id' => 4, 'name' => 'John Doe', 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar4.png', 'online' => false, 'last_active' => '2022-02-15 08:20:43',],
            (object) ['id' => 1, 'name' => 'John Doe', 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar1.png', 'online' => true, 'last_active' => '2022-02-15 07:20:43',],
            (object) ['id' => 5, 'name' => 'John Doe', 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar2.png', 'online' => true, 'last_active' => '2022-02-15 07:20:43',],
            (object) ['id' => 3, 'name' => 'John Doe', 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar3.png', 'online' => false, 'last_active' => '2022-02-15 08:20:43',],
            (object) ['id' => 4, 'name' => 'John Doe', 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar4.png', 'online' => false, 'last_active' => '2022-02-15 08:20:43',],
        ];

        $this->user = [
            'id' => 2,
            'name' => 'John Doe',
            'username' => 'emon',
            'image_url' => 'https://bootdey.com/img/Content/avatar/avatar1.png',
        ];
    }

    function sendMessage()
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
            event(new SendMessage($message->to_id, $message));
            array_push($this->messages, $message);
            $this->emit('sendMessage', $message);
            $this->message = '';
        }
    }

    public function render()
    {
        return view('livewire.chat.chat');
    }
}
