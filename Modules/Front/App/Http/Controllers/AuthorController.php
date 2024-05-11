<?php

namespace Modules\Front\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\User\App\Models\User;

class AuthorController extends Controller
{
    public function index(User $user): View
    {
        return view('front::author.index', ['author' => $user]);
    }
}
