<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;

class Chat extends Component
{
    public $message;
    public array $messages = [];
    public array $users = [];
    public array $user;

    public function mount()
    {
        $this->messages = [
            (object) ['from_id' => 1, 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar1.png', 'body' => 'Hello, how are you?', 'created_at' => '2020-01-01 00:00:00',],
            (object) ['from_id' => 2, 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar2.png', 'body' => 'Hello, how are you?', 'created_at' => '2020-01-01 00:00:00',],
            (object) ['from_id' => 2, 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar2.png', 'body' => 'Hello, how are you?', 'created_at' => '2020-01-01 00:00:00',],
            (object) ['from_id' => 1, 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar1.png', 'body' => 'Hello, how are you?', 'created_at' => '2020-01-01 00:00:00',],
            (object) ['from_id' => 2, 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar2.png', 'body' => 'Hello, how are you?', 'created_at' => '2020-01-01 00:00:00',],
            (object) ['from_id' => 1, 'image_url' => 'https://bootdey.com/img/Content/avatar/avatar1.png', 'body' => 'Hello, how are you?', 'created_at' => '2020-01-01 00:00:00',],
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
            'image_url' => 'https://bootdey.com/img/Content/avatar/avatar1.png',
        ];
    }

    public function render()
    {
        return view('livewire.chat.chat');
    }
}
