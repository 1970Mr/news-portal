<?php

namespace Modules\Panel\App\Helpers;

class ViewHelpers
{
    public static function hasActiveChild($menu): bool
    {
        foreach ($menu['children'] as $child_menu) {
            if (is_array($child_menu) && url()->current() === $child_menu['url']) return true;
        }
        return false;
    }
}
