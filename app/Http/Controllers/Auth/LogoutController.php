<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserLoggedOut;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LogoutController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        $logoutTime = Carbon::now();
        Auth::user()->update(['is_online' => false, 'last_active' => $logoutTime]);
        event(new UserLoggedOut(Auth::user()->id, $logoutTime));

        Auth::logout();

        return redirect(route('home'));
    }
}
