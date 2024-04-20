<?php

namespace Modules\Profile\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        $user = auth()->user();
        return view('profile::edit-profile', compact('user'));
    }

    public function update(): RedirectResponse
    {
        return to_route('profile.edit');
    }
}
