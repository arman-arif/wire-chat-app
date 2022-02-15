<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;

class Chat extends Component
{
    public $message;
    public $messages = [];
    public $users;
    public $user;

    public function mount()
    {
        $this->messages = [
            (object) ['user_id' => 1, 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar1.png', 'body' => 'Hello, how are you?', 'created_at' => '2020-01-01 00:00:00',],
            (object) ['user_id' => 2, 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar2.png', 'body' => 'Hello, how are you?', 'created_at' => '2020-01-01 00:00:00',],
            (object) ['user_id' => 2, 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar2.png', 'body' => 'Hello, how are you?', 'created_at' => '2020-01-01 00:00:00',],
        ];
    }

    public function render()
    {
        return view('livewire.chat.chat')
            ->layout('layouts.app');
    }
}
