<?php

use Illuminate\Support\Facades\Cache;

if (!function_exists('isOnline')) {
    function isOnline($user_id)
    {
        return Cache::has('user-is-online-' . $user_id);
    }
}
