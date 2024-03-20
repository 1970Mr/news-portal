<?php

use Modules\Common\App\Helpers\JalalianHelper;

function menu_has_active_child($menu, $class = 'active'): string
{
    foreach ($menu['children'] as $child_menu) {
        if (is_array($child_menu) && url()->current() === $child_menu['url']) return $class;
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
