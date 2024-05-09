<?php

namespace Modules\Profile\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Profile\App\Http\Requests\ProfileRequest;
use Modules\Profile\App\Services\ProfileService;

class ProfileController extends Controller
{
    public function __construct(private readonly ProfileService $profileService)
    {
        $this->middleware('can:' . config('permissions_list.PROFILE_EDIT', false));
    }

    public function edit(): View
    {
        $user = auth()->user();
        return view('profile::edit-profile', compact('user'));
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $this->profileService->update($request);
        return to_route(config('app.panel_prefix', 'panel') . '.profile.edit')->with('success', __('entity_edited', ['entity' => __('profile')]));
    }
}
