<?php

namespace App\View\Components\Chat;

use Carbon\Carbon;
use Illuminate\View\Component;

class Message extends Component
{
    public $style1;
    public $style2;
    public $time;
    public $message;
    // public $image;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($messageData)
    {
        $this->style1 = "";
        $this->style2 = "my-message";
        if ($messageData->user_id == auth()->user()->id) {
            $this->style1 = "text-end";
            $this->style2 = "other-message float-right";
        }
        // $this->image = $messageData->image_url; //"https://bootdey.com/img/Content/avatar/avatar1.png";
        $this->time = Carbon::parse($messageData->created_at)->format('h:i A, D'); //"10:12 AM, Today";
        $this->message = $messageData->body; //$data['message'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.chat.message');
    }
}
