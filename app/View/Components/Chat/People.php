<?php

namespace App\View\Components\Chat;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\Component;

class People extends Component
{
    public $is_online;
    public $is_active;
    public $last_active;
    public $image_url;
    public $active_status;
    public $full_name;
    public $user_id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user, $active)
    {
        $this->user_id  = $user->id ?? 0;
        $this->is_online = $user->is_online ? 'online' : "offline";
        $this->is_active = ($active['id'] == $this->user_id) ? 'active' : '';
        $this->last_active = Carbon::parse($user->last_active ?? 0)->diffForHumans();
        $this->active_status = ($user->is_online ?? false) ? 'Online' : $this->last_active;
        $this->image_url  = $user->image_url ?? asset('assets/avatar.png');
        $this->full_name  = $user->name ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.chat.people');
    }
}
