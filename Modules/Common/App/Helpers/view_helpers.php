<?php

use Illuminate\Support\Facades\Route;
use Modules\Common\App\Helpers\JalalianHelper;

function active_menu($menu, $class = 'current'): string
{
    if (isset($menu['url']) && url()->current() === $menu['url'])
        return $class;
    if (! array_key_exists('active_routes', $menu))
        return '';
    foreach ($menu['active_routes'] as $url) {
        if (Route::currentRouteName() === $url)
            return $class;
    }
    return '';
}

function jalalian(): JalalianHelper
{
    return new JalalianHelper();
}

function status_class($status): string
{
    return ($status) ? 'text-success' : 'text-danger';
}

function status_message($status): string
{
    return ($status) ? __('active') : __('inactive');
}

function nullable_value($value): string
{
    return $value ?: __('have_not');
}

function front_date_format($date): string
{
    return jalalian()->forge($date)->format(config('common.front_date_format'));
}

function front_active_menu($url, $class = 'active'): string
{
    return request()->url() === $url ? $class : '';
}
