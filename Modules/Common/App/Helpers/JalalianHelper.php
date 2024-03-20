<?php

namespace Modules\Common\App\Helpers;

use Morilog\Jalali\Jalalian;

class JalalianHelper
{
    public function __call($method, $args)
    {
        return call_user_func_array([Jalalian::class, $method], $args);
    }
}
