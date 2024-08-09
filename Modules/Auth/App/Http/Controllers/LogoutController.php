<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class LogoutController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        auth()->logout();

        return to_route('home.index');
    }
}
