<?php

namespace Modules\Profile\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Profile\App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function edit(): View
    {
        $user = auth()->user();
        return view('profile::edit-profile', compact('user'));
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        auth()->user()?->update($request->validated());
        return to_route('profile.edit')->with('success', __('entity_edited', ['entity' => __('profile')]));
    }
}
