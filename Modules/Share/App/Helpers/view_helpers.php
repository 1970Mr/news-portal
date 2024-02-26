<?php

function menu_has_active_child($menu, $class = 'active'): string
{
    foreach ($menu['children'] as $child_menu) {
        if (is_array($child_menu) && url()->current() === $child_menu['url']) return $class;
    }
    return '';
}