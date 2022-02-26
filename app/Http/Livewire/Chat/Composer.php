<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;

class Composer extends Component
{
    public string $message = '';
    public $attachment = null;

    public $listeners = [
        'sent' => 'messageSent',
    ];

    public function mount($message)
    {
        $this->message = $message;
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|min:1',
        ]);

        $this->emitUp('send', [
            'message' => $this->message
        ]);

        $this->message = '';
    }

    public function messageSent()
    {
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.chat.composer');
    }
}
