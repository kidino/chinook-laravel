<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('get_navigation')) {
    function get_navigation()
    {
        $menu = config('navigation');
        $user = Auth::user();

        return array_filter($menu, function ($item) use ($user) {
            // Check if the user has any of the roles required for the menu item
            return isset($item['roles']) && $user && $user->roles->pluck('name')->intersect($item['roles'])->isNotEmpty();
        });
    }
}